<?php

use Illuminate\Database\Seeder;
use App\OpenEnd;

class OpenEndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpenEnd::updateOrCreate(['size' => '6 x 9 1/2 - 22 3/8 x 8 7/8 #146']);
        OpenEnd::updateOrCreate(['size' => '4 1/8 x 9 1/2 - 12 3/16 x 9 1/4 #118']);
        OpenEnd::updateOrCreate(['size' => '9 x 12 - 18 3/4 x 15 - #153']);
        OpenEnd::updateOrCreate(['size' => '9 1/2 x 12 1/2 - 19 3/4 x 15 5/8 - #156']);
        OpenEnd::updateOrCreate(['size' => '10 x 13 - 20 5/8 x 15 7/8 - #159']);
        OpenEnd::updateOrCreate(['size' => '12 x 15 1/2 - 18 1/2 x 25 - #162']);
    }
}
