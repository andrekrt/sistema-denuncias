<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DenunciaLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::query()->latest()->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', [
            'usuario' => $usuario,
            'perfils' => User::perfis()
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'perfil' => ['required', Rule::in(array_keys(User::perfis()))],
        ]);

        if ($request->user()->id === $usuario->id && $request->user()->isAdmin() && $dados['perfil'] !== User::PERFIL_ADMIN) {
            return back()->withInput()->with('error', 'Você não pode remover o próprio perfil de administrador.');
        }

        $dadosAntes = [
            'name' => $usuario->name,
            'email' => $usuario->email,
            'perfil' => $usuario->perfil,
        ];

        $usuario->update($dados);

        $usuario->refresh();

        $alteracoes = [];

        if ($dadosAntes['name'] !== $usuario->name) {
            $alteracoes[] = "nome de \"{$dadosAntes['name']}\" para \"{$usuario->name}\"";
        }

        if ($dadosAntes['email'] !== $usuario->email) {
            $alteracoes[] = "e-mail de \"{$dadosAntes['email']}\" para \"{$usuario->email}\"";
        }

        if ($dadosAntes['perfil'] !== $usuario->perfil) {
            $perfilAnteriorLabel = User::perfis()[$dadosAntes['perfil']] ?? ucfirst($dadosAntes['perfil']);

            $alteracoes[] = "perfil de \"{$perfilAnteriorLabel}\" para \"{$usuario->perfilLabel()}\"";
        }

        $descricaoAlteracoes = count($alteracoes)
            ? implode('; ', $alteracoes)
            : 'nenhuma alteração detectada';

        DenunciaLogService::registrar(
            $request,
            'editou_usuario',
            null,
            "Editou o usuário {$usuario->name} ({$usuario->email}): {$descricaoAlteracoes}."
        );

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function create()
    {
        return view('admin.usuarios.create', ['perfils' => User::perfis()]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed', 'string'],
            'perfil' => ['required', Rule::in(array_keys(User::perfis()))],
        ]);

        $novoUsuario =  User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
            'perfil' => $dados['perfil'],
        ]);

        DenunciaLogService::registrar(
            $request,
            denuncia: null,
            acao: 'criou_usuario',
            descricao: "Criou o usuário {$novoUsuario->name} ({$novoUsuario->email}) com perfil {$novoUsuario->perfilLabel()}."
        );

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }
}
