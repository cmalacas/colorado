<?php

use Illuminate\Database\Seeder;

use App\PurchaseOrder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class PurchaseOrderSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'purchase_orders';
        $this->filename = base_path() . '/storage/csv/PurchaseOrders.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::error('xxxxx');
        DB::disableQueryLog();
        
        DB::table($this->table)->truncate();

        parent::run();

    }
}
