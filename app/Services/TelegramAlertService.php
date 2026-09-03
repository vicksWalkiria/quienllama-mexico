<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Phone;
use Illuminate\Support\Facades\Log;

class TelegramAlertService
{
    /**
     * Enviar alerta automática de denuncia o comentario al Topic de Telegram correspondiente.
     */
    public static function sendSpamReport(Phone $phone, Comment $comment, string $countryCode = 'MX'): bool
    {
        $botToken = config('services.telegram.bot_token') ?: env('TELEGRAM_BOT_TOKEN');
        $chatId = config('services.telegram.chat_id') ?: env('TELEGRAM_CHAT_ID', '-1004307956048');

        if (empty($botToken) || empty($chatId)) {
            return false;
        }

        // Mapeo exacto de Topics por País
        $threadId = match (strtoupper($countryCode)) {
            'MX' => 8,
            'CL' => 6,
            'AR' => 4,
            'ES' => 2,
            default => null,
        };

        $countryFlag = match (strtoupper($countryCode)) {
            'MX' => '🇲🇽 México',
            'CL' => '🇨🇱 Chile',
            'AR' => '🇦🇷 Argentina',
            'ES' => '🇪🇸 España',
            default => $countryCode,
        };

        $formatted = method_exists($phone, 'formatted') ? $phone->formatted() : $phone->number;
        $url = route('phone.show', $phone->number);
        $author = htmlspecialchars($comment->author_name ?: 'Anónimo');
        $reason = htmlspecialchars($comment->reason ?: 'Llamada sospechosa');
        $content = htmlspecialchars(mb_strimwidth(strip_tags($comment->content), 0, 500, '...'));
        $location = htmlspecialchars($phone->location ?: 'México');

        $text = "🚨 <b>Nueva Denuncia en QuiénLlama {$countryFlag}</b>\n\n"
              . "📞 <b>Número:</b> <code>{$formatted}</code>\n"
              . "📍 <b>Ubicación:</b> {$location}\n"
              . "⚠️ <b>Motivo:</b> {$reason}\n"
              . "👤 <b>Autor:</b> {$author}\n"
              . "📊 <b>Puntuación SPAM:</b> {$phone->spam_score}/100\n\n"
              . "💬 <b>Detalle del reporte:</b>\n"
              . "<i>\"{$content}\"</i>\n\n"
              . "🔗 <a href=\"{$url}\">Ver ficha completa y comentarios en la web</a>";

        $payload = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];

        if ($threadId !== null) {
            $payload['message_thread_id'] = $threadId;
        }

        try {
            $ch = curl_init("https://api.telegram.org/bot{$botToken}/sendMessage");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            return $response !== false;
        } catch (\Throwable $e) {
            Log::warning("Telegram report alert error: " . $e->getMessage());
            return false;
        }
    }
}
