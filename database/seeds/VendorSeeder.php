<?php

use Illuminate\Database\Seeder;

use App\Vendor;
use Flynsarmy\CsvSeeder\CsvSeeder;

class VendorSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->table = 'vendors';
        $this->filename = base_path() . '/storage/csv/Vendors.csv';
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
