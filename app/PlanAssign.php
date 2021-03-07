<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAssign extends Model
{

    protected $table = "plan_assign";

    protected $fillable = [
        'plan_id',
        'model_type',
        'model_id',
        'date'
    ];

    protected $appends = [
        'can_delete'
    ];


}
