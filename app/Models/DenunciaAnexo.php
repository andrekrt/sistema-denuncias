<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DenunciaAnexo extends Model
{
    protected $fillable = [
        'denuncia_id',
        'nome_original',
        'caminho',
        'mime_type',
        'tamanho',
    ];

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }
}
