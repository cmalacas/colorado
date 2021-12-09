<?php

use Illuminate\Database\Seeder;
use App\ColoStock;

class ColoStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColoStock::updateOrCreate(['size' => 'Plain Furnished']);
        ColoStock::updateOrCreate(['size' => 'Litho Stock Furnished']);
        ColoStock::updateOrCreate(['size' => '24 White Wove House Stock']);
        ColoStock::updateOrCreate(['size' => '6 3/4 Reg-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '6 3/4 Std Wdw-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '7 3/4 Reg-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '7 3/4 Std Wdw-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '9 Reg-24SWW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '9 Std Wdw-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '10 Reg-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '10 Std Wdw-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '6 x 9 OS-24WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '9 x 12 OE-28WW-Stk Envelopes']);
        ColoStock::updateOrCreate(['size' => '9 x 12 OS-28WW-Stk ']);
    }
}
