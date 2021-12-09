<?php

use Illuminate\Database\Seeder;
use App\InsideTintStyle;

class InsideTintStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsideTintStyle::updateOrCreate(['style' => 'Basket Weave']);     
        InsideTintStyle::updateOrCreate(['style' => 'Chicken Scratch']);     
        InsideTintStyle::updateOrCreate(['style' => 'Clouds']);     
        InsideTintStyle::updateOrCreate(['style' => 'Confetti']);     
        InsideTintStyle::updateOrCreate(['style' => 'Diagonal Lines']);     
        InsideTintStyle::updateOrCreate(['style' => 'Fabric Weave']);     
        InsideTintStyle::updateOrCreate(['style' => 'Linen']);     
        InsideTintStyle::updateOrCreate(['style' => 'MW Ribbon']);     
        InsideTintStyle::updateOrCreate(['style' => 'Wavy Lines']);     
    }
}
