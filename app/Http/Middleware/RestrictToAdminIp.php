<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToAdminIp
{
    /**
     * Handle an incoming request.
     * Restringe el acceso exclusivamente a la IP pública de Víctor Alonso o localhost.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIpsConfig = config('app.admin_allowed_ips', env('ADMIN_ALLOWED_IPS', '81.202.45.23,127.0.0.1,::1'));
        $allowedIps = array_map('trim', explode(',', (string) $allowedIpsConfig));

        $clientIp = $request->ip();

        if (!in_array($clientIp, $allowedIps, true)) {
            abort(403, 'Acceso denegado: IP no autorizada.');
        }

        return $next($request);
    }
}
