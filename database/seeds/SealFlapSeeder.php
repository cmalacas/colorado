<?php

use Illuminate\Database\Seeder;
use App\SealFlap;

class SealFlapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SealFlap::updateOrCreate(['sealFlap' => 'Extended']);        
        SealFlap::updateOrCreate(['sealFlap' => 'Folded']);        
    }
}
