<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        if ($ip === '::1') {
            $ip = '127.0.0.1';
        }
        $userAgent = $request->header('User-Agent');
        $url = $request->url();

        // Example API to get location data from IP
        $location = Http::get("https://ipapi.co/{$ip}/json")->json();

        Visitor::create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'country' => $location['country_name'] ?? 'Unknown',
            'url' => $url,
        ]);

        return $next($request);
    }
}
