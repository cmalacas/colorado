<?php

use Illuminate\Database\Seeder;
use App\OptionPrint;

class PrintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OptionPrint::updateOrCreate(['print' => 'Flexo']);
        OptionPrint::updateOrCreate(['print' => 'Inside Tint']);
        OptionPrint::updateOrCreate(['print' => 'Jet']);
    }
}
