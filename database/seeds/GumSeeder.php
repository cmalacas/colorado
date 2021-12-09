<?php

use Illuminate\Database\Seeder;
use App\Gum;

class GumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gum::updateOrCreate(['gum' => 'Split']);        
        Gum::updateOrCreate(['gum' => 'Full']);        
        Gum::updateOrCreate(['gum' => 'Latex']);        
        Gum::updateOrCreate(['gum' => 'Resin']);        
        Gum::updateOrCreate(['gum' => 'No Seal']);        
    }
}
