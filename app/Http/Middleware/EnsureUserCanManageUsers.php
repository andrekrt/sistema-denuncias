<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanManageUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    if(! $request->user() || ! $request->user()->podeGerenciarUsuarios()){
        abort(403, 'Você não tem permissão para gerenciar usuários.');
    }

        return $next($request);
    }
}
