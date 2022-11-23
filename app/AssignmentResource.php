<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentResource extends Model
{
    public function role() {
        return $this->belongsTo('App\Role', 'role_id');
    }
}
