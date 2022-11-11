<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('funnel_cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('funnel')->nullable();
            $table->uuid('person')->nullable();
            $table->uuid('imovel')->nullable();
            $table->string('order');

            $table->timestamps();
            $table->boolean('status')->default(true);
            $table->foreign('funnel')->references('id')->on('funnels');
            $table->foreign('person')->references('id')->on('people');

        });
    }

    public function down()
    {
        Schema::dropIfExists('funnel_cards');
    }
};
