<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanAccessDenuncias
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! $request->user() || ! $request->user()->podeAcessarDenuncias()) {
            abort(403, 'Você não tem permissão para acessar as denúncias');
        }

        return $next($request);
    }
}
