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
        Schema::create('turmas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curso')->nullable();
            $table->string('nome');
            $table->string('nivel');
            $table->boolean('maximo_alunos')->default(false);
            $table->integer('numero_maximo_alunos')->default(false);
            $table->timestamps();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('turmas');
    }
};
