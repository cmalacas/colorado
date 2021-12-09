<?php

use Illuminate\Database\Seeder;
use App\Description;

class DescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Description::updateOrCreate(['description' => 'Reg']);
        Description::updateOrCreate(['description' => 'Open Side Side Seam']);
        Description::updateOrCreate(['description' => 'Open Side Booklet']);
        Description::updateOrCreate(['description' => 'Open End Catalog']);
        Description::updateOrCreate(['description' => 'Open Side Adjustable']);
        Description::updateOrCreate(['description' => 'Open End Adjustable']);
        Description::updateOrCreate(['description' => 'Open End Adjustable Wdw']);
        Description::updateOrCreate(['description' => 'Open End Catalog Wdw']);
        Description::updateOrCreate(['description' => 'Open Side Adjustable Wdw']);
        Description::updateOrCreate(['description' => 'Openside Booklet Wdw']);
        Description::updateOrCreate(['description' => 'Wdw']);
        Description::updateOrCreate(['description' => 'Open Side Side Seam Wdw
        ']);
    }
}
