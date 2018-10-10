<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regional')->unique();
            $table->boolean('estado')->default(true);
            $table->integer('idunidad')->unsigned();
            $table->timestamps();

            $table->foreign('idunidad')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regionales');
    }
}
