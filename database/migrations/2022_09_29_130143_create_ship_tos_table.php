<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_tos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shipto', 255)->nullable();
            $table->string('address1', 255)->nullable();
            $table->string('address2', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip', 25)->nullable();
            $table->string('attn', 255)->nullable();
            $table->string('phone', 25)->nullable();
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
        Schema::dropIfExists('ship_tos');
    }
}
