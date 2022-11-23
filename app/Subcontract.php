<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcontract extends Model
{
    //
    public function assignment() {
        return $this->hasMany('App\Assignment', 'Assignment_subproject_id');
    }
}
