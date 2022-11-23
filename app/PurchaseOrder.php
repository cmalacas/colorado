<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function items() {
        return $this->hasMany('App\PurchaseOrderItem', 'purchase_order_id');
    }

    public function customer() {
        return $this->belongsTo('App\Customer', 'to');
    }

    public function vendor() {
        return $this->belongsTo('App\Vendor', 'to');
    } 

    public function documents() {

        return $this->hasMany('App\PurchaseOrderDocument', 'purchase_order_id');

    }

}
