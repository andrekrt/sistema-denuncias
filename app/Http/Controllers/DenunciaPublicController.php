<?php

namespace App\Http\Controllers;

use App\Mail\NovaDenunciaRegistrada;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DenunciaPublicController extends Controller
{
    public function create()
    {
        return view('denuncias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'tipo' => ['required', 'string', 'max:255'],
                'descricao' => ['required', 'string', 'min:20'],
                'data_ocorrido' => ['nullable', 'date'],
                'local' => ['nullable', 'string', 'max:255'],
                'envolvidos' => ['nullable', 'string'],
                'testemunhas' => ['nullable', 'string'],
                'anonima' => ['nullable', 'boolean'],
                'nome' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'email', 'max:255'],
                'telefone' => ['nullable', 'string', 'max:50'],
                'anexos*' => ['nullable', 'array', 'max:5'],
                'anexos.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
            ],
            [
                'tipo.required' => 'Selecione o tipo da denúncia.',
                'descricao.required' => 'Informe a descrição do ocorrido.',
                'descricao.min' => 'A descrição deve ter pelo menos :min caracteres.',
                'data_ocorrido.date' => 'Informe uma data válida.',
                'local.max' => 'O local ou setor deve ter no máximo :max caracteres.',
                'nome.max' => 'O nome deve ter no máximo :max caracteres.',
                'email.email' => 'Informe um e-mail válido.',
                'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
                'telefone.max' => 'O telefone deve ter no máximo :max caracteres.',
                'anexos.max' => 'Você pode anexar no máximo :max arquivos.',
                'anexos.*.file' => 'Os itens anexados devem ser arquivos válidos.',
                'anexos.*.max' => 'Cada arquivo não pode exceder 5MB.',
                'anexos.*.mimes' => 'Os arquivos anexados devem ser do tipo: JPG, PNG, PDF, DOC ou DOCX.',
            ],
            [
                'tipo' => 'tipo da denúncia',
                'descricao' => 'descrição',
                'data_ocorrido' => 'data do ocorrido',
                'local' => 'local ou setor',
                'envolvidos' => 'pessoas envolvidas',
                'testemunhas' => 'testemunhas',
                'nome' => 'nome',
                'email' => 'e-mail',
                'telefone' => 'telefone',
            ]
        );

        $anonima = $request->boolean('anonima');

        if ($anonima) {
            $validated['nome'] = null;
            $validated['email'] = null;
            $validated['telefone'] = null;
        }

        $senhaAcompanhamento = strtoupper(Str::random(10));

        $denuncia = Denuncia::create([
            'protocolo' => $this->gerarProtocolo(),
            'senha_acompanhamento_hash' => Hash::make($senhaAcompanhamento),
            'tipo' => $validated['tipo'],
            'descricao' => $validated['descricao'],
            'data_ocorrido' => $validated['data_ocorrido'] ?? null,
            'local' => $validated['local'] ?? null,
            'envolvidos' => $validated['envolvidos'] ?? null,
            'testemunhas' => $validated['testemunhas'] ?? null,
            'anonima' => $anonima,
            'nome' => $validated['nome'] ?? null,
            'email' => $validated['email'] ?? null,
            'telefone' => $validated['telefone'] ?? null,
            'status' => Denuncia::STATUS_RECEBIDA,
            'prioridade' => 'normal',
        ]);

        if ($request->hasFile('anexos')) {
            foreach ($request->file('anexos') as $arquivo) {
                $caminho = $arquivo->store('denuncias/' . $denuncia->id, 'local');

                $denuncia->anexos()->create([
                    'nome_original' => $arquivo->getClientOriginalName(),
                    'caminho' => $caminho,
                    'mime_type' => $arquivo->getClientMimeType(),
                    'tamanho' => $arquivo->getSize(),
                ]);
            }
        }

        $emailsDestino = config('denuncias.emails_destino');

        if (! empty($emailsDestino)) {
            Mail::to($emailsDestino)->send(new NovaDenunciaRegistrada($denuncia));
        }

        return view('denuncias.sucesso', [
            'denuncia' => $denuncia,
            'senhaAcompanhamento' => $senhaAcompanhamento,
        ]);
    }

    private function gerarProtocolo()
    {
        do {
            $protocolo = 'FRB-' . now()->format('Y') . '-' . str_pad((string) random_int(1, 99999), 6, '0', STR_PAD_LEFT);
        } while (Denuncia::where('protoco', $protocolo)->exists());

        return $protocolo;
    }
}
