<?php

use Illuminate\Database\Seeder;

use App\OutDiagonal;
use Flynsarmy\CsvSeeder\CsvSeeder;

class OutDiagonalSeeder extends CsvSeeder
{
    public function __construct() 
    {
        $this->table = 'out_diagonals';
        $this->filename = base_path() . '/storage/csv/out_diagonals.csv';
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