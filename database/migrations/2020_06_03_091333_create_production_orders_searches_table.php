<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionOrdersSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_orders_searches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->int('user_id');
            $table->string('lookin', 100);
            $table->string('search', 255)->nullable();
            $table->string('match', 50);


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
        Schema::dropIfExists('production_orders_searches');
    }
}
