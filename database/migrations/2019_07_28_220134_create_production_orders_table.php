<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SoldTo', 50)->nullable();
            $table->string('JobTitle', 50)->nullable();
            $table->string('CustPO', 50)->nullable();
            $table->string('PreviousOrder', 50)->nullable();
            $table->string('QuotedPrice', 13)->nullable();
            $table->string('AdditionalChg', 200)->nullable();
            $table->date('OrderDate')->default(Carbon::now());
            $table->date('StockDueIn')->default(Carbon::now());
            $table->date('DateDue')->default(Carbon::now());
            $table->string('ContactName', 50)->nullable();
            $table->string('Phone', 15)->nullable();
            $table->string('Fax', 15)->nullable();
            $table->string('Alt', 15)->nullable();
            $table->string('Machine1', 50)->nullable();
            $table->string('Machine2', 50)->nullable();
            $table->string('Machine3', 50)->nullable();
            $table->string('Machine4', 50)->nullable();
            $table->string('Machine5', 50)->nullable();
            $table->string('Machine6', 50)->nullable();
            $table->integer('QtyNeeded')->default(0);
            $table->string('UnitFigure', 50)->nullable();
            $table->integer('OversAllow')->default(0);
            $table->string('Total', 50)->nullable();
            $table->boolean('RunAll');
            $table->string('SizeDimension1', 50)->nullable();
            $table->string('SizeDimension2', 50)->nullable();
            $table->text('Desc')->nullable();
            $table->string('SealFlapSz', 50)->nullable();
            $table->string('WindowSz1', 50)->nullable();
            $table->string('WindowSz2', 50)->nullable();
            $table->string('WindowSz3', 50)->nullable();
            $table->string('WindowPos1', 50)->nullable();
            $table->string('OpenPolyWinPos1', 50)->nullable();
            $table->string('WindowPos2', 50)->nullable();
            $table->string('OpenPolyWinPos2', 50)->nullable();
            $table->string('WindowPos3', 50)->nullable();
            $table->string('OpenPolyWinPos3', 50)->nullable();
            $table->string('WindowDoubleDie', 50)->nullable();
            $table->string('SealFlap', 50)->nullable();
            $table->string('GumType', 50)->nullable();
            $table->boolean('SampleProv');
            $table->string('AmountForJets', 50)->nullable();
            $table->string('ofCopies', 50)->nullable();
            $table->text('SpecialConvInst')->nullable();
            $table->string('StockType', 50)->nullable();
            $table->string('StockWeight', 50)->nullable();
            $table->string('StockSize', 50)->nullable();
            $table->string('OutDiagonal', 255)->nullable();
            $table->string('OutSide', 255)->nullable();
            $table->string('OutCatalogEnd', 255)->nullable();
            $table->string('OutCatalogSide', 50)->nullable();
            $table->string('CrossGrain', 50)->nullable();
            $table->string('StraightGrain', 50)->nullable();
            $table->string('ColoEnvStock', 50)->nullable();
            $table->string('ColoEnvStockFrom', 50)->nullable();
            $table->text('CustomerSupp')->nullable();
            $table->string('StrKnifSealFlapSz', 50)->nullable();
            $table->string('StrKnifBackFlapSz', 50)->nullable();
            $table->string('StrKnifSideFlapSz', 50)->nullable();
            $table->text('SpecialCuttingInst', 50)->nullable();
            $table->string('Printing', 50)->nullable();
            $table->string('InsideTintStyle', 50)->nullable();
            $table->string('Sides', 50)->nullable();
            $table->string('Colors1', 50)->nullable();
            $table->string('Colors2', 50)->nullable();
            $table->string('Colors3', 50)->nullable();
            $table->boolean('ProofReqd');
            $table->text('CustomerSup')->nullable();
            $table->text('SpecialPrintInst')->nullable();
            $table->boolean('BulkPack');
            $table->string('BulkAmtPerCtn', 50)->nullable();
            $table->string('BulkAmtPerBox', 50)->nullable();
            $table->string('BulkBoxSz', 50)->nullable();
            $table->boolean('FoldingBox');
            $table->string('FoldingAmtPerBox', 50)->nullable();
            $table->string('FoldingBoxSz', 50)->nullable();
            $table->string('FoldingCtnSize', 50)->nullable();
            $table->string('Labeling', 50)->nullable();
            $table->boolean('SpecialLabels');
            $table->text('MarkAs')->nullable();
            $table->boolean('CPU');
            $table->boolean('SHIPVIA');
            $table->string('ShipViaDetail', 50)->nullable();
            $table->string('Account', 50)->nullable();
            $table->string('ShipTo', 50)->nullable();
            $table->string('Address1', 50)->nullable();
            $table->string('Address2', 50)->nullable();
            $table->string('City', 50)->nullable();
            $table->string('ST', 5)->nullable();
            $table->string('Zip',10)->nullable();
            $table->string('ShipAttn', 50)->nullable();
            $table->string('ShipContactPhone', 15)->nullable();
            $table->date('TodayDate')->default(Carbon::now());
            $table->string('Boxes', 50)->nullable();
            $table->text('For')->nullable();
            $table->string('DateReqd',15)->nullable();
            $table->string('Quantity', 15)->nullable();
            $table->text('Description')->nullable();
            $table->decimal('Price', 15, 2)->default(0);
            $table->decimal('AddCharge', 15, 2)->default(0);
            $table->text('Comments')->nullable();
            $table->boolean('OrderComplete');
            $table->date('DateComplete')->default(Carbon::now());
            $table->string('RelPurchOrder', 50)->nullable();
            $table->string('To', 50)->nullable();
            $table->string('Ship', 50)->nullable();
            $table->string('ShippingCompany', 50)->nullable();
            $table->string('For2', 50)->nullable();
            $table->date('DateRequired')->default(Carbon::now());
            $table->string('Quantity2', 15)->nullable();
            $table->text('Description2')->nullable();
            $table->decimal('Price2', 15, 2);
            $table->decimal('AdditionalCharges', 15, 2);
            $table->text('Comments2')->nullable();
            $table->text('Notes')->nullable();
            $table->boolean('Invoiced');
            $table->date('FoldingDue')->default(Carbon::now());
            $table->date('JetDue')->default(Carbon::now());
            $table->string('JetStock', 50)->nullable();
            $table->string('Location', 50)->nullable();
            $table->string('FoldingScheduleStatus', 50)->nullable();
            $table->integer('FoldingOrder')->default(0);
            $table->string('JetScheduleStatus', 50)->nullable();
            $table->integer('JetOrder')->default(0);
            $table->string('StraightKnifeScheduleStatus', 50)->nullable();
            $table->integer('StraightKnifeOrder')->default(0);
            $table->date('DateStockIn')->default(Carbon::now());
            $table->string('SheetSize', 50)->nullable();
            $table->string('NumberOut', 50)->nullable();
            $table->text('SHIPPINGINSTRUCTIONS')->nullable();


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
        Schema::dropIfExists('production_orders');
    }
}
