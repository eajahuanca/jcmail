<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTematicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tematicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tematica')->unique();
            $table->decimal('saldo_inicial',18,2);
            $table->decimal('saldo_actual',18,2);
            $table->decimal('costo',18,2);
            $table->integer('userid_registra')->unsigned();
            $table->integer('userid_actualiza')->unsigned();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('userid_registra')->references('id')->on('users');
            $table->foreign('userid_actualiza')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tematicas');
    }
}
