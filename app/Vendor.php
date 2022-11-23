<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function contacts() {

        return $this->hasMany('App\VendorContact', 'vendor_id');

    }
}
