<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function company() {
        $this->belongsTo('App\Customer', 'customer_id');
    }
}
