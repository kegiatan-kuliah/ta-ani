<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'code','name','condition','quantity','price','year','photo','description','status','category_id','sub_category_id','group_id','location_id'
    ];
}
