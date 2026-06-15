<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Denuncia extends Model
{
    // constantes de status
    public const STATUS_RECEBIDA = 'recebida';
    public const STATUS_EM_ANALISE = 'em_analise';
    public const STATUS_EM_APURACAO = 'em_apuracao';
    public const STATUS_AGUARDANDO_INFORMACOES = 'aguardando_informacoes';
    public const STATUS_CONCLUIDA = 'concluida';
    public const STATUS_ARQUIVADA = 'arquivada';

    // Constantes de tipos de denuncias
    public const TIPO_ASSEDIO_MORAL = 'assedio_moral';
    public const TIPO_ASSEDIO_SEXUAL = 'assedio_sexual';
    public const TIPO_DISCRIMINACAO = 'discriminacao';
    public const TIPO_FRAUDE = 'fraude';
    public const TIPO_CONFLITO_INTERESSES = 'conflito_interesses';
    public const TIPO_SEGURANCA_TRABALHO = 'seguranca_trabalho';
    public const TIPO_OUTROS = 'outros';

    public static function tipos(): array
    {
        return [
            self::TIPO_ASSEDIO_MORAL => 'Assédio moral',
            self::TIPO_ASSEDIO_SEXUAL => 'Assédio sexual',
            self::TIPO_DISCRIMINACAO => 'Discriminação',
            self::TIPO_FRAUDE => 'Fraude ou desvio',
            self::TIPO_CONFLITO_INTERESSES => 'Conflito de interesses',
            self::TIPO_SEGURANCA_TRABALHO => 'Segurança do trabalho',
            self::TIPO_OUTROS => 'Outros',
        ];
    }

    public static function statusDisponiveis(): array
    {
        return [
            self::STATUS_RECEBIDA => 'Recebida',
            self::STATUS_EM_ANALISE => 'Em análise',
            self::STATUS_EM_APURACAO => 'Em apuração',
            self::STATUS_AGUARDANDO_INFORMACOES => 'Aguardando informações',
            self::STATUS_CONCLUIDA => 'Concluída',
            self::STATUS_ARQUIVADA => 'Arquivada',
        ];
    }

    public function tipoLabel(): string
    {
        return self::tipos()[$this->tipo] ?? ucfirst(str_replace('_', ' ', $this->tipo));
    }

    public function statusLabel(): string
    {
        return self::statusDisponiveis()[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function statusClasses(): string
    {
        return match ($this->status) {
            self::STATUS_RECEBIDA => 'bg-red-50 text-red-800 ring-red-100',
            self::STATUS_EM_ANALISE => 'bg-amber-50 text-amber-800 ring-amber-100',
            self::STATUS_EM_APURACAO => 'bg-orange-50 text-orange-800 ring-orange-100',
            self::STATUS_AGUARDANDO_INFORMACOES => 'bg-yellow-50 text-yellow-800 ring-yellow-100',
            self::STATUS_CONCLUIDA => 'bg-green-50 text-green-800 ring-green-100',
            self::STATUS_ARQUIVADA => 'bg-slate-100 text-slate-700 ring-slate-200',
            default => 'bg-slate-100 text-slate-700 ring-slate-200',
        };
    }

    public function prioridadeLabel(): string
    {
        return match ($this->prioridade) {
            'baixa' => 'Baixa',
            'normal' => 'Normal',
            'alta' => 'Alta',
            'urgente' => 'Urgente',
            default => ucfirst($this->prioridade ?? 'Normal'),
        };
    }

    protected $fillable = [
        'protocolo',
        'senha_acompanhamento_hash',
        'tipo',
        'descricao',
        'data_ocorrido',
        'local',
        'envolvidos',
        'testemunhas',
        'anonima',
        'nome',
        'email',
        'telefone',
        'status',
        'prioridade',
        'responsavel_id',
    ];

    protected $casts = [
        'data_ocorrido' => 'date',
        'anonima' => 'boolean',
    ];

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(DenunciaComentario::class);
    }

    public function anexos(): HasMany
    {
        return $this->hasMany(DenunciaAnexo::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(DenunciaLog::class);
    }
}
