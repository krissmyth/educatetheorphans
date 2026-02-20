<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Track page view
        try {
            // Don't track admin routes or certain excluded paths
            $excludedPaths = ['admin', 'api/', 'storage/', 'public/'];
            $path = $request->path();
            
            $shouldTrack = true;
            foreach ($excludedPaths as $excluded) {
                if (strpos($path, $excluded) === 0) {
                    $shouldTrack = false;
                    break;
                }
            }

            if ($shouldTrack && $request->method() === 'GET') {
                PageView::create([
                    'page_url' => $request->url(),
                    'page_name' => $this->getPageName($request->path()),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referer' => $request->header('referer'),
                    'user_id' => Auth::check() ? Auth::id() : null,
                ]);
            }
        } catch (\Exception $e) {
            // Silently fail if tracking fails
            Log::warning('Page view tracking failed: ' . $e->getMessage());
        }

        return $next($request);
    }

    private function getPageName($path): string
    {
        $pathMap = [
            '/' => 'Home',
            '/about' => 'About',
            '/news' => 'News',
            '/projects' => 'Projects',
            '/stories' => 'Stories',
            '/get-involved' => 'Get Involved',
            '/donate' => 'Donate',
            '/contact' => 'Contact',
            '/dashboard' => 'Dashboard',
        ];

        // Check exact match
        if (isset($pathMap[$path])) {
            return $pathMap[$path];
        }

        // Check prefix match
        foreach ($pathMap as $route => $name) {
            if ($route !== '/' && strpos($path, rtrim($route, '/')) === 0) {
                return $name;
            }
        }

        // Return formatted path as fallback
        return ucfirst(str_replace('/', ' - ', trim($path, '/'))) ?: 'Home';
    }
}
