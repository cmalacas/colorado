<?php

use Illuminate\Database\Seeder;

use App\OutMoCatalog;
use Flynsarmy\CsvSeeder\CsvSeeder;

class OutMoCatalogSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'out_mo_catalogs';
        $this->filename = base_path() . '/storage/csv/OutMoCatalog.csv';
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