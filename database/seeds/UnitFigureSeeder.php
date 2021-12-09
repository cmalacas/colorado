<?php

use Illuminate\Database\Seeder;
use App\UnitFigure;

class UnitFigureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitFigure::updateOrCreate(['figure' => 'Lot']);
        UnitFigure::updateOrCreate(['figure' => 'Per M']);
        UnitFigure::updateOrCreate(['figure' => 'Misc']);
    }
}
