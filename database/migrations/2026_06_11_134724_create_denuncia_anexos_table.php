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
        Schema::create('denuncia_anexos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('denuncia_id')
                ->constrained('denuncias')
                ->cascadeOnDelete();

            $table->string('nome_original');
            $table->string('caminho');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('tamanho')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncia_anexos');
    }
};
