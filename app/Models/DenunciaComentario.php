<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaComentario extends Model
{
    protected $fillable = [
        'denuncia_id',
        'user_id',
        'mensagem',
        'visivel_denunciante',
    ];

    protected $casts = [
        'visivel_denunciante' => 'boolean',
    ];

    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
