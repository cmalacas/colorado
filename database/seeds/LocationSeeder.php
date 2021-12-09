<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::updateOrCreate(['location' => 'W/F Stock']);
        Location::updateOrCreate(['location' => 'W/F PC Stock']);
        Location::updateOrCreate(['location' => 'W/F Proof']);
        Location::updateOrCreate(['location' => 'W/F Neg']);
        Location::updateOrCreate(['location' => 'Folding']);
        Location::updateOrCreate(['location' => 'Jet']);
        Location::updateOrCreate(['location' => 'Cutting']);
        Location::updateOrCreate(['location' => 'Latex/PS']);
        Location::updateOrCreate(['location' => 'Straight Knife']);
        Location::updateOrCreate(['location' => 'Complete']);
    }
}
