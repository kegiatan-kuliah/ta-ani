<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'application_id','date','return_plan_date','approval_date','reg_no','purpose','needs','notes','attachment','status','asset_id','employee_id'
    ];
}
