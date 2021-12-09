<?php

use Illuminate\Database\Seeder;

use App\OutSideSeam;
use Flynsarmy\CsvSeeder\CsvSeeder;

class OutSideSeamSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'out_side_seams';
        $this->filename = base_path() . '/storage/csv/OutSideSeam.csv';
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