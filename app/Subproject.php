<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subproject extends Model
{
    public function project() {
        return $this->belongsTo('App\Project', 'Subproject_project_id');
    }

    public function assignments() {
        return $this->hasMany('App\Assignment', 'Assignment_subproject_id');
    }

    public function level_2() {
        return $this->belongsTo('App\Zone_level_2', 'Subproject_level');
    }

    public function complition_rate() {
        $total = 0;

        $budget = $this->total_budget();

        foreach($this->assignments as $assignment) {

            $rate = $assignment->current_rates();

            if ($budget > 0) {
                $total += ($assignment->Assignment_budget / $budget) * $rate;
            }
        }

        return $total;
    }

    public function total_budget() {
        $budget = 0;

        foreach($this->assignments as $assignment) {
            $budget += $assignment->Assignment_budget;            
        }

        return $budget;
    }

    public function cost() {
        
        $budget = 0;
        $expense = 0;

        $items = [];

        $hours = 0;

        foreach($this->assignments as $assignment) {
            
            $budget += $assignment->Assignment_budget;            

            $totals = $assignment->totals();

            $hours += $totals['used'];

        }

        foreach($this->assignments as $assignment) {
            
            foreach($assignment->assignment_items as $item) {
                
               $contract =  $item->contract_item;

               if (isset($items[$contract->Item_id]['total'])) {
                    $total = $items[$contract->Item_id]['total'] + $item->quantity;
                } else {
                    $total = $item->quantity;
                }

                $items[$contract->Item_id]['quantity'] = $contract->Quantity;
                $items[$contract->Item_id]['price'] = $contract->Price;
                $items[$contract->Item_id]['total'] = $total;

            }
        }

        foreach($items as $item) {
            $expense += ($item['total'] * $item['price']);
        }

        $expense += $hours;

        return $expense;
    }

    public function timesheets_by_user($user_id, $start, $end) {
        
        $timesheets = [];

        foreach($this->assignments as $assignment) {
            
            foreach($assignment->timesheets as $ts) {

                if ( (($user_id == 0) || $user_id == $ts->Timesheet_user_id) && 
                     (($start == '' || $end == '') || ($ts->Timesheet_date >= $start && $ts->Timesheet_date <= $end)) )  
                {

                    $timesheets[] = $ts;

                }    
            }
        }

        return $timesheets;
    }

    public function timesheets() {
        return $this->hasManyThrough('App\Timesheet', 'App\Assignment', 'Assignment_subproject_id', 'Timesheet_assignment_id');
    }


    public function total_hours() {

        $hours = 0;

        foreach($this->assignments as $a) {
            $hours += $a->total_hours();
        }

        return $hours;

    }
    
}
