<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\RedefinirSenhaNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Override;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'perfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public const PERFIL_ADMIN = 'admin';
    public const PERFIL_COMITE = 'comite';
    public const PERFIL_VISUALIZADOR = 'visualizador';

    public static function perfis(): array
    {
        return [
            self::PERFIL_ADMIN => 'Admin',
            self::PERFIL_COMITE => 'Comitê',
            self::PERFIL_VISUALIZADOR => 'Visualizador',
        ];
    }

    public function perfilLabel(): string
    {
        return self::perfis()[$this->perfil] ?? ucfirst($this->perfil);
    }

    public function perfilClasses(): string
    {
        return match ($this->perfil) {
            self::PERFIL_ADMIN => 'bg-red-50 text-red-800 ring-red-100',
            self::PERFIL_COMITE => 'bg-amber-50 text-amber-800 ring-amber-100',
            self::PERFIL_VISUALIZADOR => 'bg-slate-100 text-slate-700 ring-slate-200',
            default => 'bg-slate-100 text-slate-700 ring-slate-200',
        };
    }

    public function isAdmin(): bool
    {
        return $this->perfil === self::PERFIL_ADMIN;
    }

    public function isComite(): bool
    {
        return $this->perfil === self::PERFIL_COMITE;
    }

    public function isVisualizador(): bool
    {
        return $this->perfil === self::PERFIL_VISUALIZADOR;
    }

    public function podeAcessarDenuncias(): bool
    {
        return in_array($this->perfil, [
            self::PERFIL_ADMIN,
            self::PERFIL_COMITE,
            self::PERFIL_VISUALIZADOR,
        ], true);
    }

    public function podeGerenciarUsuarios(): bool
    {
        return $this->isAdmin();
    }

    public function podeAtuarEmDenuncias(): bool
    {
        return in_array($this->perfil, [
            self::PERFIL_ADMIN,
            self::PERFIL_COMITE,
        ], true);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new RedefinirSenhaNotification($token));
    }
}
