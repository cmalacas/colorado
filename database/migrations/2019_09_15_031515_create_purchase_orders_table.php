<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ColoEnvPO')->nullable();
            $table->string('to', 100)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('fax', 25)->nullable();
            $table->date('todaysdate')->nullable();
            $table->string('ship', 100)->nullable();
            $table->string('shippingco', 100)->nullable();
            $table->string('for', 100)->nullable();
            $table->date('datereqd')->nullable();
            $table->text('comments')->nullable();
            $table->text('desc1')->nullable();
            $table->text('desc2')->nullable();
            $table->text('desc3')->nullable();
            $table->text('desc4')->nullable();
            $table->text('desc5')->nullable();
            $table->text('desc6')->nullable();
            $table->text('desc7')->nullable();
            $table->text('desc8')->nullable();
            $table->text('desc9')->nullable();
            $table->text('desc10')->nullable();
            $table->text('desc11')->nullable();
            $table->text('desc12')->nullable();
            $table->text('desc13')->nullable();
            $table->text('desc14')->nullable();
            $table->text('desc15')->nullable();
            $table->text('desc16')->nullable();
            $table->text('desc17')->nullable();
            $table->text('desc18')->nullable();
            $table->text('desc19')->nullable();
            $table->text('desc20')->nullable();
            $table->text('qty1')->nullable();
            $table->text('qty2')->nullable();
            $table->text('qty3')->nullable();
            $table->text('qty4')->nullable();
            $table->text('qty5')->nullable();
            $table->text('qty6')->nullable();
            $table->text('qty7')->nullable();
            $table->text('qty8')->nullable();
            $table->text('qty9')->nullable();
            $table->text('qty10')->nullable();
            $table->text('qty11')->nullable();
            $table->text('qty12')->nullable();
            $table->text('qty13')->nullable();
            $table->text('qty14')->nullable();
            $table->text('qty15')->nullable();
            $table->text('qty16')->nullable();
            $table->text('qty17')->nullable();
            $table->text('qty18')->nullable();
            $table->text('qty19')->nullable();
            $table->text('qty20')->nullable();
            $table->text('price1')->nullable();
            $table->text('price2')->nullable();
            $table->text('price3')->nullable();
            $table->text('price4')->nullable();
            $table->text('price5')->nullable();
            $table->text('price6')->nullable();
            $table->text('price7')->nullable();
            $table->text('price8')->nullable();
            $table->text('price9')->nullable();
            $table->text('price10')->nullable();
            $table->text('price11')->nullable();
            $table->text('price12')->nullable();
            $table->text('price13')->nullable();
            $table->text('price14')->nullable();
            $table->text('price15')->nullable();
            $table->text('price16')->nullable();
            $table->text('price17')->nullable();
            $table->text('price18')->nullable();
            $table->text('price19')->nullable();
            $table->text('price20')->nullable();
            $table->text('addchg1')->nullable();
            $table->text('addchg2')->nullable();
            $table->text('addchg3')->nullable();
            $table->text('addchg4')->nullable();
            $table->text('addchg5')->nullable();
            $table->text('addchg6')->nullable();
            $table->text('addchg7')->nullable();
            $table->text('addchg8')->nullable();
            $table->text('addchg9')->nullable();
            $table->text('addchg10')->nullable();
            $table->text('addchg11')->nullable();
            $table->text('addchg12')->nullable();
            $table->text('addchg13')->nullable();
            $table->text('addchg14')->nullable();
            $table->text('addchg15')->nullable();
            $table->text('addchg16')->nullable();
            $table->text('addchg17')->nullable();
            $table->text('addchg18')->nullable();
            $table->text('addchg19')->nullable();
            $table->text('addchg20')->nullable();
            $table->string('recvd1', 25)->nullable();
            $table->string('recvd2', 25)->nullable();
            $table->string('recvd3', 25)->nullable();
            $table->string('recvd4', 25)->nullable();
            $table->string('recvd5', 25)->nullable();
            $table->string('recvd6', 25)->nullable();
            $table->string('recvd7', 25)->nullable();
            $table->string('recvd8', 25)->nullable();
            $table->string('recvd9', 25)->nullable();
            $table->string('recvd10', 25)->nullable();
            $table->string('recvd11', 25)->nullable();
            $table->string('recvd12', 25)->nullable();
            $table->string('recvd13', 25)->nullable();
            $table->string('recvd14', 25)->nullable();
            $table->string('recvd15', 25)->nullable();
            $table->string('recvd16', 25)->nullable();
            $table->string('recvd17', 25)->nullable();
            $table->string('recvd18', 25)->nullable();
            $table->string('recvd19', 25)->nullable();
            $table->string('recvd20', 25)->nullable();
            $table->date('date1')->nullable();
            $table->date('date2')->nullable();
            $table->date('date3')->nullable();
            $table->date('date4')->nullable();
            $table->date('date5')->nullable();
            $table->date('date6')->nullable();
            $table->date('date7')->nullable();
            $table->date('date8')->nullable();
            $table->date('date9')->nullable();
            $table->date('date10')->nullable();
            $table->date('date11')->nullable();
            $table->date('date12')->nullable();
            $table->date('date13')->nullable();
            $table->date('date14')->nullable();
            $table->date('date15')->nullable();
            $table->date('date16')->nullable();
            $table->date('date17')->nullable();
            $table->date('date18')->nullable();
            $table->date('date19')->nullable();
            $table->date('date20')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
