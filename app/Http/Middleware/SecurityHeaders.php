<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Control referrer information sent with requests
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');

        // Disable browser features not needed by this site
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=(), encrypted-media=*');

        // Content Security Policy — deferred until production deployment.
        // CSP requires browser dev tools to audit all resource sources before enabling.

        return $response;
    }
}
