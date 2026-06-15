<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denuncia;
use App\Services\DenunciaLogService;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function index(Request $request)
    {

        $query = Denuncia::query();

        if ($request->filled('busca')) {
            $busca = trim($request->input('busca'));

            $query->where(function ($q) use ($busca) {
                $q->where('protocolo', 'like', "%{$busca}%")
                    ->orWhere('nome', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%")
                    ->orWhere('local', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('identificacao')) {
            if ($request->identificacao === 'anonima') {
                $query->where('anonima', true);
            }

            if ($request->identificacao === 'identificada') {
                $query->where('anonima', false);
            }
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        $denuncias = $query->latest()->paginate(5)->withQueryString();

        return view('admin.denuncias.index', [
            'denuncias' => $denuncias,
            'filtros' => $request->only([
                'busca',
                'status',
                'tipo',
                'identificacao',
                'data_inicio',
                'data_fim',
            ]),
            'tipos' => Denuncia::tipos(),
            'statusDisponiveis' => Denuncia::statusDisponiveis(),
        ]);
    }

    public function show(Request $request, Denuncia $denuncia)
    {

        $denuncia->load(['comentarios.usuario', 'anexos', 'logs.usuario']);

        return view('admin.denuncias.show', [
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

    public function updateStatus(Request $request, Denuncia $denuncia)
    {

        if (!$request->user()->podeAtuarEmDenuncias()) {
            abort(403, 'Você não tem permissão par alterar o status da denúncia');
        }

        $validated = $request->validate(
            [
                'status' => ['required', 'string', 'in:recebida,em_analise,em_apuracao,aguardando_informacoes,concluida,arquivada'],
                [
                    'status.required' => 'Selecione um status.',
                    'status.in' => 'Status inválido.'
                ],
            ]
        );

        $statusAnterior = $denuncia->status;

        $denuncia->update([
            'status' => $validated['status']
        ]);

        DenunciaLogService::registrar($request, 'alterou_status', $denuncia, "Alterou o status de {$statusAnterior} para {$validated['status']}.");

        return back()->with('success', 'Status atualizado com sucesso.');
    }
}
