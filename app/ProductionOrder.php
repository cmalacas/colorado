<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionOrder extends Model
{
    use SoftDeletes;

    public function customer() {
        return $this->belongsTo('App\Customer', 'CustomerId');
    }

    public function purchase_order_items() {
        return $this->hasMany('App\PurchaseOrderItem', 'production_order_id');
    }

   

}
