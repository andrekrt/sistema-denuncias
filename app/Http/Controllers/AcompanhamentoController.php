<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AcompanhamentoController extends Controller
{
    public function form()
    {
        return view('acompanhamento.form');
    }

    public function show(Request $request)
    {
        $validated = $request->validate(
            [
                'protocolo' => ['required', 'string'],
                'senha_acompanhamento' => ['required', 'string'],
            ],
            [
                'protocolo.required' => 'O campo de protocolo é obrigatório.',
                'senha_acompanhamento.required' => 'O campo de senha de acompanhamento é obrigatório.',
            ]
        );

        $denuncia = Denuncia::where('protocolo', strtoupper(trim($validated['protocolo'])))->first();

        if (!$denuncia || ! Hash::check($validated['senha_acompanhamento'], $denuncia->senha_acompanhamento_hash)) {
            return back()->withErrors([
                'protocolo' => 'Protocolo ou senha de acompanhamento inválidos.'
            ])->withInput();
        }

        $denuncia->load([
            'comentarios' => function ($query) {
                $query->where('visivel_denunciante', true)->orderBy('created_at');
            },
        ]);

        return view('acompanhamento.show', [
            'denuncia' => $denuncia,
            'statusFormatado' => $this->formatarStatus($denuncia->status)
        ]);
    }

    private function formatarStatus($status)
    {
        return match ($status) {
            Denuncia::STATUS_RECEBIDA => 'Recebida',
            Denuncia::STATUS_EM_ANALISE => 'Em Análise',
            Denuncia::STATUS_EM_APURACAO => 'Em Apuração',
            Denuncia::STATUS_AGUARDANDO_INFORMACOES => 'Aguardando Informações',
            Denuncia::STATUS_CONCLUIDA => 'Concluída',
            Denuncia::STATUS_ARQUIVADA => 'Arquivada',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }
}
