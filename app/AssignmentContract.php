<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentContract extends Model
{
    public function contract_item() {
        return $this->belongsTo('App\ContractItem', 'contract_item_id');
    }

    public function item() {
        return $this->belongsTo('App\Item', 'contract_item_id');
    }

    public function assignment() {
        return $this->belongsTo('App\Assignment', 'assignment_id');
    }
}
