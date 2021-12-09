<?php

use Illuminate\Database\Seeder;
use App\OpenSide;

class OpenSideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpenSide::updateOrCreate(['size' => '9 x 12 - 19 9/16 x 14 3/16 - #154']);
        OpenSide::updateOrCreate(['size' => '9 1/4 x 11 31/32 -19 3/4 - 13 11/16 - #160']);
        OpenSide::updateOrCreate(['size' => '9 1/2 x 9 1/2 - 20 x 14 1/4  - #157']);
        OpenSide::updateOrCreate(['size' => '7 1/2 x 10 1/2 - 16 x 12 1/4 - #124']);
        OpenSide::updateOrCreate(['size' => '10 x 13 - 21 7/16 x 15 - # 158']);
        OpenSide::updateOrCreate(['size' => '8 3/4 x 11 1/2 - 18 15/16 x 13 1/2 - # 161']);
        OpenSide::updateOrCreate(['size' => '9 x 12 - 19 9/16 x `13 11/16 - Accurate Die']);
        OpenSide::updateOrCreate(['size' => '9 x 11 1/2 - #155']);
    }
}
