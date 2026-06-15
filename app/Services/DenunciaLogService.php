<?php

namespace App\Services;

use App\Models\Denuncia;
use App\Models\DenunciaLog;
use Illuminate\Http\Request;

class DenunciaLogService
{
    public static function registrar(
        Request $request,
        string $acao,
        ?Denuncia $denuncia = null,
        ?string $descricao = null
    ): void {
        DenunciaLog::create([
            'denuncia_id' => $denuncia?->id,
            'user_id' => auth()->id(),
            'acao' => $acao,
            'descricao' => $descricao,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
