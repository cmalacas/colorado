<?php

use Illuminate\Database\Seeder;

use App\Order;
use Flynsarmy\CsvSeeder\CsvSeeder;

class OrdersSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'orders';
        $this->filename = base_path() . '/storage/csv/Orders.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        
        DB::table($this->table)->truncate();

        parent::run();

    }
}