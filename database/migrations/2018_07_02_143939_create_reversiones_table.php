<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReversionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reversiones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_reversion');
            $table->string('cite_manual');
            $table->integer('idtematica')->unsigned();
            $table->decimal('cantidad_actual',18,2);
            $table->decimal('cantidad_reversion',18,2);
            $table->decimal('total',18,2);
            $table->boolean('estado')->default(true);
            $table->text('observaciones')->nullable();
            $table->integer('userid_registra')->unsigned();
            $table->integer('userid_actualiza')->unsigned();
            $table->timestamps();

            $table->foreign('idtematica')->references('id')->on('tematicas');
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
        Schema::dropIfExists('reversiones');
    }
}
