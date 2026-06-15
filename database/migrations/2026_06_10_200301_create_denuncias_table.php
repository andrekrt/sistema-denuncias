<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();

            $table->string('protocolo')->unique();
            $table->string('senha_acompanhamento_hash');

            $table->string('tipo');
            $table->longText('descricao');

            $table->date('data_ocorrido')->nullable();
            $table->string('local')->nullable();

            $table->text('envolvidos')->nullable();
            $table->text('testemunhas')->nullable();

            $table->boolean('anonima')->default(true);

            $table->string('nome')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();

            $table->string('status')->default('recebida');
            $table->string('prioridade')->default('normal');

            $table->foreignId('responsavel_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
