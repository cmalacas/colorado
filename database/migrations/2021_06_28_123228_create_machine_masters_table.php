<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('machine', 100)->nullable( false );
            $table->integer('category')->default( 0 );
            $table->integer('status')->default( 1 );
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
        Schema::dropIfExists('machine_masters');
    }
}
