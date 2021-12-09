<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutDiagoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_diagoals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('die_size', 100)->nullable();
            $table->string('sheet_size', 100)->nullable();
            $table->string('number_out', 10)->nullable();
            $table->string('die_number', 10)->nullable();
            $table->string('seal_flap_size', 10)->nullable();

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
        Schema::dropIfExists('out_diagoals');
    }
}
