<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id'); // Chave primária auto-incrementada
            $table->unsignedInteger('user_id')->unique(); // Chave estrangeira única referenciando 'users'
            $table->longText('bio_data')->nullable(); // Biografia detalhada do doutor
            $table->string('status')->nullable(); // Status atual do doutor

            // Definição da chave estrangeira referenciando 'id' na tabela 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Criação de colunas 'created_at' e 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
