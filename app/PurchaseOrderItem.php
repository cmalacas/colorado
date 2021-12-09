<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    public $timestamps = false;

    public function purchase_order() {
        return $this->belongsTo('App\PurchaseOrder', 'purchase_order_id');
    }
}
