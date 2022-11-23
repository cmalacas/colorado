<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone_level_1 extends Model
{
    public function project() {
        return $this->belongsTo('App\Project', 'ProjectId');
    }

    public function level_2() {
        return $this->hasMany('App\Zone_level_2', 'ZoneLevel1');
    }

    public function total_budget() {
        $total = 0;

        foreach($this->level_2 as $level) {
            $total += $level->total_budget();
        }

        return $total;
    }

    public function completion_rate() {
        $total = 0;
        $budget = $this->total_budget();

        foreach($this->level_2 as $level) {
            if ($budget > 0) {
                $total += ($level->total_budget() / $budget * $level->completion_rate());
            }    
        }

        return $total;
    }

    public function total_cost() {

        $cost = 0;

        foreach($this->level_2 as $level) {

            $cost += $level->total_cost();

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

        foreach($this->level_2 as $l) {
            $hours = $l->total_hours();
        }

        return $hours;
    }
}
