<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackingSlipSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_slip_subs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('PurchaseOrdersNo');
            $table->date('DateShip');
            $table->string('Boxes', 25)->nullable();
            $table->string('QtyPerBox', 25)->nullable();
            $table->string('TotalShip', 25)->nullable();
            $table->string('Details', 100)->nullable();
            $table->string('OrderStatus', 15)->nullable();
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
        Schema::dropIfExists('packing_slip_subs');
    }
}
