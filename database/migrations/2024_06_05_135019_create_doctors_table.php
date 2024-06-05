<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'doctors' com as colunas e chaves necessárias.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id'); // Chave primária auto-incrementada
            $table->unsignedInteger('doc_id')->unique(); // Chave estrangeira única referenciando 'users'
            $table->string('category')->nullable(); // Categoria do doutor
            $table->unsignedInteger('patients')->nullable(); // Número de pacientes
            $table->longText('bio_data')->nullable(); // Biografia detalhada do doutor
            $table->string('status')->nullable(); // Status atual do doutor

            // Definição da chave estrangeira referenciando 'id' na tabela 'users'
            $table->foreign('doc_id')->references('id')->on('users')->onDelete('cascade');

            // Criação de colunas 'created_at' e 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'doctors'.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
