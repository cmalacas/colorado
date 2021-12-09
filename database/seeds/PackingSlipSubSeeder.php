<?php

use Illuminate\Database\Seeder;

use App\PackingSlipSub;
use Flynsarmy\CsvSeeder\CsvSeeder;

class PackingSlipSubSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'packing_slip_subs';
        $this->filename = base_path() . '/storage/csv/PackingSlipSubTable.csv';
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

