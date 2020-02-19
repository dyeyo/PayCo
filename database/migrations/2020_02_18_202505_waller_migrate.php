<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WallerMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('dinner');
            $table->bigInteger('docuement');
            $table->string('name');
            $table->bigInteger('id_cliente');

            $table->foreign('id_cliente')->references('id')->on('clients');
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
        Schema::dropIfExists('wallets');

    }
}
