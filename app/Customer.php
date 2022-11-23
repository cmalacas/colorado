<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function contacts() {
        return $this->hasMany('App\Contact', 'customer_id');
    }

    public function shiptos() {
        return $this->hasMany('App\ShipTo', 'customer_id');
    }
}
