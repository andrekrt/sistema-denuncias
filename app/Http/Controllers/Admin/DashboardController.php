<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denuncia;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Denuncia::count();

        $contadores = [
            'recebidas' => Denuncia::where('status', Denuncia::STATUS_RECEBIDA)->count(),
            'em_analise' => Denuncia::where('status', Denuncia::STATUS_EM_ANALISE)->count(),
            'em_apuracao' => Denuncia::where('status', Denuncia::STATUS_EM_APURACAO)->count(),
            'aguardando_informacoes' => Denuncia::where('status', Denuncia::STATUS_AGUARDANDO_INFORMACOES)->count(),
            'concluidas' => Denuncia::where('status', Denuncia::STATUS_CONCLUIDA)->count(),
            'arquivadas' => Denuncia::where('status', Denuncia::STATUS_ARQUIVADA)->count(),
        ];

        $ultimasDenuncias = Denuncia::query()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'total' => $total,
            'contadores' => $contadores,
            'ultimasDenuncias' => $ultimasDenuncias,
        ]);
    }
}
