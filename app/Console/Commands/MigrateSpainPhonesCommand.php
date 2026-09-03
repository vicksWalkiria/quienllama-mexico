<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Phone;
use App\Models\Search;
use App\Services\AreaCodeService;
use App\Services\ChilePhoneHelper;
use Illuminate\Console\Command;
use PDO;

class MigrateSpainPhonesCommand extends Command
{
    protected $signature = 'phones:migrate-from-spain 
                            {--spain-db= : Ruta personalizada al archivo SQLite de España}
                            {--dry-run : Muestra qué teléfonos se migrarían sin guardar cambios}
                            {--delete-from-spain : Elimina los registros migrados de la base de datos de España}';

    protected $description = 'Migra teléfonos con prefijos y códigos de área chilenos (+56) desde la BD de QuiénLlama España';

    public function handle(): int
    {
        $this->info("🔍 Iniciando escaneo de la base de datos de QuiénLlama España para números de Chile...");

        $spainDbPath = $this->option('spain-db') 
            ?: (file_exists('/home/aprendiz/web/quienllama.com.es/private/database.sqlite')
                ? '/home/aprendiz/web/quienllama.com.es/private/database.sqlite'
                : '/media/victor/externo/webs/quienllama/database.sqlite');

        if (!file_exists($spainDbPath)) {
            $this->error("❌ No se encontró la base de datos de España en: {$spainDbPath}");
            return Command::FAILURE;
        }

        $this->info("📂 Base de datos de origen: {$spainDbPath}");

        $spainDb = new PDO("sqlite:{$spainDbPath}");
        $spainDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $spainDb->query("SELECT id, number, spam_score, created_at FROM phones");
        $spainPhones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->info("📊 Total teléfonos examinados en España: " . count($spainPhones));

        $migratedPhones = 0;
        $migratedComments = 0;
        $dryRun = $this->option('dry-run');
        $deleteFromSpain = $this->option('delete-from-spain');

        $rowsToDisplay = [];

        foreach ($spainPhones as $sp) {
            $origNum = $sp['number'];
            $clean = preg_replace('/[^0-9]/', '', $origNum);

            // Detección: Si empieza explícitamente por 56 seguido de 9 dígitos
            $isChilean = false;
            $chileNumber = null;

            if (str_starts_with($clean, '56') && strlen($clean) === 11) {
                $chileNumber = substr($clean, 2);
                $isChilean = ChilePhoneHelper::isValid($chileNumber);
            } elseif (str_starts_with($clean, '0056') && strlen($clean) === 13) {
                $chileNumber = substr($clean, 4);
                $isChilean = ChilePhoneHelper::isValid($chileNumber);
            }

            if (!$isChilean || !$chileNumber) {
                continue;
            }

            $areaInfo = ChilePhoneHelper::getAreaInfo($chileNumber);

            $rowsToDisplay[] = [
                'Original' => $origNum,
                'Migrado a Chile' => $chileNumber,
                'Área' => $areaInfo['code'],
                'Ubicación' => $areaInfo['location'],
                'Spam Score' => $sp['spam_score']
            ];

            if ($dryRun) {
                $migratedPhones++;
                continue;
            }

            // Insertar o actualizar en Chile
            $phone = Phone::firstOrCreate(
                ['number' => $chileNumber],
                [
                    'area_code' => $areaInfo['code'],
                    'location' => $areaInfo['location'],
                    'spam_score' => $sp['spam_score'],
                    'views' => 1,
                    'created_at' => $sp['created_at'],
                ]
            );
            $migratedPhones++;

            // Migrar comentarios
            $commStmt = $spainDb->prepare("SELECT content, reason, created_at FROM comments WHERE phone_id = ?");
            $commStmt->execute([$sp['id']]);
            $comments = $commStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($comments as $c) {
                Comment::firstOrCreate(
                    [
                        'phone_id' => $phone->id,
                        'content' => $c['content'],
                    ],
                    [
                        'reason' => $c['reason'],
                        'author_name' => 'Usuario QuiénLlama',
                        'ip_hash' => hash('sha256', 'migrated_spain_chile'),
                        'created_at' => $c['created_at'],
                    ]
                );
                $migratedComments++;
            }

            if ($deleteFromSpain) {
                $delC = $spainDb->prepare("DELETE FROM comments WHERE phone_id = ?");
                $delC->execute([$sp['id']]);
                $delP = $spainDb->prepare("DELETE FROM phones WHERE id = ?");
                $delP->execute([$sp['id']]);
            }
        }

        if (!empty($rowsToDisplay)) {
            $this->table(['Original', 'Migrado a Chile', 'Área', 'Ubicación', 'Spam Score'], $rowsToDisplay);
        }

        if ($dryRun) {
            $this->warn("⚠️ MODO SIMULACIÓN (--dry-run): Se habrían migrado {$migratedPhones} teléfonos.");
        } else {
            $this->info("✅ Migración completada:");
            $this->info("   • Teléfonos migrados: {$migratedPhones}");
            $this->info("   • Comentarios migrados: {$migratedComments}");
            if ($deleteFromSpain) {
                $this->info("   • Registros depurados de la BD de España.");
            }
        }

        return Command::SUCCESS;
    }
}
