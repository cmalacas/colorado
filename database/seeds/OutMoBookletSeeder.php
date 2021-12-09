<?php

use Illuminate\Database\Seeder;

use App\OutDiagonal;
use Flynsarmy\CsvSeeder\CsvSeeder;

class OutMoBookletSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'out_mo_booklets';
        $this->filename = base_path() . '/storage/csv/OutMoBooklet.csv';
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