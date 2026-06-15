<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DenunciaAnexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\DenunciaLogService;

class DenunciaAnexoController extends Controller
{
    public function download(Request $request, DenunciaAnexo $anexo)
    {
        abort_unless(Storage::disk('local')->exists($anexo->caminho), 404);

        $caminhoCompleto = Storage::disk('local')->path($anexo->caminho);

        DenunciaLogService::registrar(
            $request,
            "baixou_anexo",
            $anexo->denuncia,
            "Baixou o anexo: " . $anexo->nome_original
        );

        return response()->download(
            $caminhoCompleto,
            $anexo->nome_original
        );
    }
}
