<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebRasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_ras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('die_size', 100)->nullable();
            $table->string('sheet_size', 100)->nullable();
            $table->string('number_out', 100)->nullable();
            $table->string('die_number', 100)->nullable();
            $table->string('seal_flap_size', 100)->nullable();
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
        Schema::dropIfExists('web_ras');
    }
}
