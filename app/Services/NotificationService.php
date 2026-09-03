<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Enviar alerta por email al administrador cuando se reporta un nuevo número con comentario.
     */
    public static function sendSpamReportAlert(Phone $phone, Comment $comment, Request $request): bool
    {
        $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'victor@walkiriaapps.com'));
        if (empty($adminEmail)) {
            return false;
        }

        $formatted = $phone->formatted();
        $dialing = $phone->details();
        $url = route('phone.show', $phone->number);
        $subject = "[QuiénLlama México] Nueva Denuncia Spam: {$formatted}";

        $message = "Se ha reportado un nuevo número en QuiénLlama México 🇲🇽\n\n"
                 . "Teléfono: {$formatted}\n"
                 . "Formato Internacional: " . ($dialing['international'] ?? '+52' . $phone->number) . "\n"
                 . "Ubicación / Clave LADA: {$phone->location} (LADA {$phone->area_code})\n"
                 . "Motivo: {$comment->reason}\n"
                 . "Autor: {$comment->author_name}\n\n"
                 . "Comentario:\n"
                 . "{$comment->content}\n\n"
                 . "Puntuación de SPAM: {$phone->spam_score}/100\n"
                 . "URL: {$url}\n"
                 . "IP Hash: " . ($comment->ip_hash ?? 'N/A') . "\n"
                 . "Fecha: " . date('d/m/Y H:i:s') . "\n";

        $host = parse_url(config('app.url'), PHP_URL_HOST) ?: 'mx.quienllama.com.es';
        $headers = "From: noreply@{$host}\r\n"
                 . "Content-Type: text/plain; charset=UTF-8\r\n"
                 . "X-Mailer: PHP/" . phpversion() . "\r\n";

        // Enviar también alerta al Topic de México en Telegram
        try {
            TelegramAlertService::sendSpamReport($phone, $comment, 'MX');
        } catch (\Throwable $e) {
            // Silencioso para no interferir con la petición
        }

        try {
            return @mail($adminEmail, $subject, $message, $headers);
        } catch (\Exception $e) {
            Log::warning("Error sending spam report email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Enviar alerta por email cuando un usuario envía un mensaje de contacto.
     */
    public static function sendContactMessageAlert(Request $request): bool
    {
        $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'victor@walkiriaapps.com'));
        if (empty($adminEmail)) {
            return false;
        }

        $name = strip_tags($request->input('name'));
        $email = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL);
        $sub = strip_tags($request->input('subject'));
        $body = strip_tags($request->input('message'));

        $subject = "[QuiénLlama México Contacto] {$sub} ({$name})";
        $message = "Nuevo mensaje recibido a través del formulario de contacto en QuiénLlama México 🇲🇽:\n\n"
                 . "Nombre: {$name}\n"
                 . "Email: {$email}\n"
                 . "Asunto: {$sub}\n"
                 . "IP: {$request->ip()}\n"
                 . "Fecha: " . date('d/m/Y H:i:s') . "\n\n"
                 . "Mensaje:\n"
                 . "{$body}\n";

        $host = parse_url(config('app.url'), PHP_URL_HOST) ?: 'mx.quienllama.com.es';
        $headers = "From: noreply@{$host}\r\n"
                 . ($email ? "Reply-To: {$email}\r\n" : "")
                 . "Content-Type: text/plain; charset=UTF-8\r\n"
                 . "X-Mailer: PHP/" . phpversion() . "\r\n";

        try {
            return @mail($adminEmail, $subject, $message, $headers);
        } catch (\Exception $e) {
            Log::warning("Error sending contact email: " . $e->getMessage());
            return false;
        }
    }
}
