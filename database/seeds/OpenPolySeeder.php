<?php

use Illuminate\Database\Seeder;
use App\OpenPoly;

class OpenPolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpenPoly::updateOrCreate(['openPoly' => 'Open']);
        OpenPoly::updateOrCreate(['openPoly' => 'Poly']);
    }
}
