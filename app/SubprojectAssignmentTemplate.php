<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubprojectAssignmentTemplate extends Model
{
    //
    public function subproject() {
        return $this->belongsTo('App\SubcontractTeemplate', 'subproject_template_id');
    }
    

    public function assign() {
        return $this->belongsTo('App\TypicalAssignment', 'assignment_id');
    }
}
