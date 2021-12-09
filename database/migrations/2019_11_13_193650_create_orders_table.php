<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('ColoEnvPO');
            $table->string('SoldTo', 100)->nullable();
            $table->string('JobTitle', 100)->nullable();
            $table->string('CustPO', 50)->nullable();
            $table->string('PreviousOrder', 25)->nullable();
            $table->string('QuotedPrice', 25)->nullable();
            $table->string('AdditionalChg', 50)->nullable();
            $table->date('OrderDate')->nullable();
            $table->date('StockDueIn')->nullable();
            $table->date('DateDue')->nullable();
            $table->string('ContactName', 100)->nullable();
            $table->string('Phone', 15)->nullable();
            $table->string('Fax', 15)->nullable();
            $table->string('Alt', 15)->nullable();
            $table->string('Machine1', 25)->nullable();
            $table->string('Machine2', 25)->nullable();
            $table->string('Machine3', 25)->nullable();
            $table->string('Machine4', 25)->nullable();
            $table->string('Machine5', 25)->nullable();
            $table->string('Machine6', 25)->nullable();
            $table->integer('QtyNeeded')->unsigned();
            $table->string('UnitFigure', 10)->nullable();
            $table->float('OversAllow', 5,2)->nullable();
            $table->string('Total')->nullable();
            $table->boolean('RunAll')->default(0);
            $table->string('SizeDimension1', 25)->nullable();
            $table->string('SizeDimension2', 25)->nullable();
            $table->string('SizeMO', 25)->nullable();
            $table->text('Desc')->nullable();
            $table->string('SealFlapSz1', 25)->nullable();
            $table->string('SealFlapSz2', 25)->nullable();
            $table->string('SealFlapSz3', 25)->nullable();
            $table->string('WindowPos1', 25)->nullable();
            $table->string('OpenPolyWinPos1', 25)->nullable();
            $table->string('WindowPos2', 25)->nullable();
            $table->string('OpenPolyWinPos2', 25)->nullable();
            $table->string('WindowPos3', 25)->nullable();
            $table->string('OpenPolyWinPos3', 25)->nullable();
            $table->string('WindowDoubleDie', 25)->nullable();
            $table->string('SealFlap', 25)->nullable();
            $table->string('GumType', 25)->nullable();
            $table->boolean('SampleProv');
            $table->string('AmountForJets', 25)->nullable();
            $table->string('Copies', 25)->nullable();
            $table->text('SpecialConvInst')->nullable();
            $table->string('StockType')->nullable();
            $table->string('StockWeight')->nullable();
            $table->string('StockSize')->nullable();
            $table->string('Diagonal')->nullable();
            $table->string('Outside')->nullable();
            $table->string('OutCatalogEnd')->nullable();
            $table->string('OutCatalogSide')->nullable();
            $table->string('CrossGrain')->nullable();
            $table->string('StraightGrain')->nullable();
            $table->string('ColoEnvStock')->nullable();
            $table->string('ColoEnvStockForm')->nullable();
            $table->text('CustomerSupp')->nullable();
            $table->string('StrKnifSealFlapSz')->nullable();
            $table->string('StrKnifBackFlapSz')->nullable();
            $table->string('StrKnifSideFlapSz')->nullable();
            $table->text('SpecialCuttingInst')->nullable();
            $table->string('Printing')->nullable();
            $table->string('InsideTintStyle')->nullable();
            $table->string('Sides')->nullable();
            $table->string('Colors1')->nullable();
            $table->string('Colors2')->nullable();
            $table->string('Colors3')->nullable();
            $table->boolean('ProofReqd');
            $table->text('CustomerSup')->nullable();
            $table->text('SpecialPrintInst')->nullable();
            $table->boolean('BulkPack')->nullable();
            $table->string('BulkAmtPerCtn')->nullable();
            $table->string('BulkAmtPerBox')->nullable();
            $table->string('BulkBoxSz')->nullable();
            $table->boolean('FoldingBox');
            $table->string('FoldingAmtPerBox')->nullable();
            $table->string('FoldingBoxSz')->nullable();
            $table->string('FoldingCtnSize')->nullable();
            $table->string('Labeling')->nullable();
            $table->boolean('SpecialLabels');
            $table->text('MarksAs')->nullable();
            $table->boolean('CPU')->default(0);
            $table->boolean('SHIPVIA')->default(0);
            $table->string('ShipViaDetail')->nullable();
            $table->string('Account')->nullable();
            $table->string('ShipTo')->nullable();
            $table->string('Address1')->nullable();
            $table->string('Address2')->nullable();
            $table->string('City')->nullable();
            $table->string('ST')->nullable();
            $table->string('Zip')->nullable();
            $table->string('ShipAttn')->nullable();
            $table->string('ShipContactPhone')->nullable();
            $table->date('TodayDate')->nullable();
            $table->string('Boxes')->nullable();
            $table->text('For')->nullable();
            $table->date('DateReqd')->nullable();
            $table->string('Quantity')->nullable();
            $table->text('Description')->nullable();
            $table->decimal('Price', 8,2)->nullable();
            $table->decimal('AddCharge', 8, 2)->nullable();
            $table->text('Comments')->nullable();
            $table->boolean('OrderComplete');
            $table->date('DateComplete')->nullable();
            $table->string('RelPurchOrder')->nullable();
            $table->string('To')->nullable();
            $table->string('Ship')->nullable();
            $table->string('ShippingCompany')->nullable();
            $table->string('For2')->nullable();
            $table->date('DateRequired')->nullable();
            $table->string('Quantity2')->nullable();
            $table->text('Description2')->nullable();
            $table->decimal('Price2', 8,2)->nullable();
            $table->decimal('AdditionalCharges', 8,2)->nullable();
            $table->text('Comments2')->nullable();
            $table->text('Notes')->nullable();
            $table->boolean('Invoiced')->default(0);
            $table->date('FoldingDue')->nullable();
            $table->date('JetDue')->nullable();
            $table->string('JetStock')->nullable();
            $table->string('Location')->nullable();
            $table->string('FoldingScheduleStatus')->nullable();
            $table->integer('FoldingOrder')->nullable();
            $table->string('JetScheduleStatus')->nullable();
            $table->integer('JetOrder')->nullable();
            $table->string('StraightKnifeScheduleStatus')->nullable();
            $table->integer('StraightKnifeOrder')->nullable();
            $table->date('DateStockIn')->nullable();
            $table->string('SheetSize')->nullable();
            $table->string('NumberOut')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
