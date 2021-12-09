<?php

use Illuminate\Database\Seeder;
use App\DiesMo;

class DiesMoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiesMo::updateOrCreate(['orderFirst' => '9',        'orderThen' => '12',        'size' => '9 X 12  OE']);
        DiesMo::updateOrCreate(['orderFirst' => '9.5',      'orderThen' => '12.5',      'size' => '9 1/2 X 12 1/2  OE']);
        DiesMo::updateOrCreate(['orderFirst' => '10',       'orderThen' => '13',        'size' => '10 X 13 OE']);
        DiesMo::updateOrCreate(['orderFirst' => '12',       'orderThen' => '15.5',      'size' => '12 X 15 1/2  OE']);
        DiesMo::updateOrCreate(['orderFirst' => '9',        'orderThen' => '12',        'size' => '9 X 12 BK']);
        DiesMo::updateOrCreate(['orderFirst' => '9.25',     'orderThen' => '11.96875',  'size' => '9 1/4 X 11 31/32 BK']);
        DiesMo::updateOrCreate(['orderFirst' => '9.5',      'orderThen' => '9.5',       'size' => '9 1/2 X 9 1/2 BK']);
        DiesMo::updateOrCreate(['orderFirst' => '10',       'orderThen' => '13',        'size' => '10 X 13 BK']);
        DiesMo::updateOrCreate(['orderFirst' => '4.125',    'orderThen' => '9.5',       'size' => '4 1/8 X 9 1/2 OE']);
        DiesMo::updateOrCreate(['orderFirst' => '8.75',     'orderThen' => '11.5',      'size' => '8 3/4 x 11 1/2 BK #161']);        
    }
}
