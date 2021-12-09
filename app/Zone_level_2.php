<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone_level_2 extends Model
{
    public function level_1() {
        return $this->belongsTo('App\Zone_level_1', 'ZoneLevel1');
    }

    

    public function subprojects() {
        return $this->hasMany('App\Subproject', 'Subproject_level');
    }

    public function total_budget() {
        $budget = 0;

        foreach($this->subprojects as $subproject) {
            $budget += $subproject->total_budget();
        }

        return $budget;
    }

    public function completion_rate() {

        $total = 0;

        $budget = $this->total_budget();

        foreach($this->subprojects as $subproject) {
            if ($budget > 0) {
                $total += ($subproject->total_budget() / $budget * $subproject->complition_rate());
            }
        }

        return $total;
    }

    public function total_cost() {

        $cost = 0;

        foreach($this->subprojects as $subproject) {
            
            foreach($subproject->assignments as $a) {

                $totals = $a->totals();

                $cost += $totals['used'] + $totals['used_expense'];

            }

        }


        return $cost;

    }

    public function performance() {
        
        $performance = 0;

        $cost = $this->total_cost();

        $budget = $this->total_budget();

        $complition = $this->completion_rate();

        if ($cost > 0) {
            
            $performance = $budget * ( $complition / 100 ) / $cost;
      
        }  

        return $performance;

    }

    public function total_hours() {
        $hours = 0;

        foreach($this->subprojects as $s) {
            $hours += $s->total_hours();
        }

        return $hours;
    }
}
