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
        Schema::create('alunos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('turma')->nullable();
            $table->uuid('curso')->nullable();
            $table->string('nome');
            $table->string('matricula');
            $table->string('sexo');
            $table->date('data_nascimento');
            $table->timestamps();
            $table->boolean('status')->default(true);
            $table->foreign('turma')->references('id')->on('turmas');
            $table->foreign('curso')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
};
