<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_salida');
            $table->string('cite_manual');
            $table->integer('idunidad')->unsigned(); //unidad solicitante
            $table->integer('idregional')->unsigned();
            $table->integer('idtematica')->unsigned();
            $table->decimal('cantidad_actual',18,2);
            $table->decimal('cantidad_salida',18,2);
            $table->decimal('costo', 18,2);
            $table->decimal('total',18,2);
            $table->string('correlativo',100);
            $table->boolean('estado')->default(true);
            $table->text('observaciones')->nullable();
            $table->integer('userid_registra')->unsigned();
            $table->integer('userid_actualiza')->unsigned();
            $table->timestamps();

            $table->foreign('idunidad')->references('id')->on('unidades');
            $table->foreign('idregional')->references('id')->on('regionales');
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
        Schema::dropIfExists('salidas');
    }
}
