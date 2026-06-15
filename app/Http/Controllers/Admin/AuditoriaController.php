<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DenunciaLog;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = DenunciaLog::query()->with(['usuario', 'denuncia'])->latest();

        if($request->filled('busca')){
            $busca = trim($request->busca);

            $query->where(function ($q) use ($busca){
                $q->where('acao', 'like', "%{$busca}%")
                    ->orWhere('descricao', 'like', "%{$busca}%")
                    ->orWhere('ip', 'like', "%{$busca}%")
                    ->orWhereHas('usuario', function($usuarioQuery) use ($busca){
                        $usuarioQuery->where('name', 'like', "%{$busca}%")
                            ->orWhere('email', 'like', "%{$busca}%");
                    })
                    ->orWhereHas('denuncia', function($denunciaQuery) use ($busca){
                        $denunciaQuery->where('protocolo', 'like', "%{$busca}%");
                    });
            });
        }

        if($request->filled('acao')){
            $query->where('acao', $request->acao);
        }

        if($request->filled('data_inicio')){
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        if($request->filled('data_fim')){
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        $logs = $query->paginate(15)->withQueryString();

        $acoes = DenunciaLog::query()->select('acao')->distinct()->orderBy('acao')->pluck('acao');

        return view('admin.auditoria.index', [
            'logs' => $logs,
            'acoes' => $acoes,
            'filtros' => $request->only([
                'busca', 'acao', 'data_inicio', 'data_fim'
            ])
        ]);
    }
}
