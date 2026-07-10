<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() instanceof Merchant) {
            abort(403, 'Akses hanya untuk Merchant.');
        }

        return $next($request);
    }
}
