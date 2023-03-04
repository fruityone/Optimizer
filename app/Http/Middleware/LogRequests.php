<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle($request, Closure $next)
    {
        // Log the request information to the "requests" channel
        Log::channel('requests')->info('Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => $request->header(),
            'body' => $request->all(),
        ]);

        return $next($request);
    }
}
