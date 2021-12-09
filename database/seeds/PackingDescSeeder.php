<?php

use Illuminate\Database\Seeder;
use App\PackingDesck;

class PackingDescSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackingDesck::updateOrCreate(['desc' => 'Open Side Diangonal Seam']);
        PackingDesck::updateOrCreate(['desc' => 'Open Side Side Seam']);
        PackingDesck::updateOrCreate(['desc' => 'Open Side Booklet']);
        PackingDesck::updateOrCreate(['desc' => 'Open End Catalog']);
        PackingDesck::updateOrCreate(['desc' => 'Open Side Adjustable']);
        PackingDesck::updateOrCreate(['desc' => 'Open End Adjustable']);
    }
}
