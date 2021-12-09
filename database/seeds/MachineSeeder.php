<?php

use Illuminate\Database\Seeder;
use App\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Machine::updateOrCreate(['machine' => 'Converting']);
        Machine::updateOrCreate(['machine' => 'Cutting']);
        Machine::updateOrCreate(['machine' => 'Jet']);
        Machine::updateOrCreate(['machine' => 'Latex / PS']);
        Machine::updateOrCreate(['machine' => 'RA']);
        Machine::updateOrCreate(['machine' => 'Straight Knife']);
    }

}
