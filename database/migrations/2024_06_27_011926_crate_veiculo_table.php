<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateVeiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
			$table->increments('id');
            $table->string('placa',8);
            $table->bigInteger('renavam');
            $table->text('modelo',150);
            $table->text('marca',150);
            $table->year('ano');
            $table->text('propietario');
			$table->integer('user_id')->nullable();
            $table->foreign('user_id')->constrained()->references('id')->on('users');
            $table->timestamps();
			$table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');

    }
}
