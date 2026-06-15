<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DenunciaLogService;

class DenunciaComentarioController extends Controller
{
    public function store(Request $request, Denuncia $denuncia)
    {

        if (!$request->user()->podeAtuarEmDenuncias()) {
            abort(403, 'Você não tem permissão para registrar comentários nesta denúncia.');
        }
        $validated = $request->validate(
            [
                'mensagem' => ['required', 'string', 'min:3'],
                'visivel_denunciante' => ['nullable', 'boolean']
            ],
            [
                'mensagem.required' => 'O campo de comentário é obrigatório.',
                'mensagem.min' => 'O comentário deve conter pelo menos :min caracteres.',
            ]
        );

        $visivelDenunciante = $request->boolean('visivel_denunciante');

        $comentario = $denuncia->comentarios()->create([
            'user_id' => Auth::id(),
            'mensagem' => $validated['mensagem'],
            'visivel_denunciante' => $visivelDenunciante,
        ]);

        DenunciaLogService::registrar(
            $request,
            $visivelDenunciante ? "enviou_mensagem_denunciantes" : "adicionou_comentario_interno",
            $denuncia,
            $visivelDenunciante ? "Enviou uma mensagem visível para o denunciante." : "Adicionou um comentário interno."
        );

        $mensagemRetorno = $visivelDenunciante
            ? 'Comentário adicionado e visível para o denunciante.'
            : 'Comentário adicionado, mas não visível para o denunciante.';

        return redirect()->route('admin.denuncias.show', $denuncia)->with('success', $mensagemRetorno);
    }
}
