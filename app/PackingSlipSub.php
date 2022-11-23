<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackingSlipSub extends Model
{
    public function production_order()  {
        return $this->belongsTo('App\ProductionOrder', 'ColoEnvPO');
    }
}
