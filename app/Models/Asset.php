<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'code','name','condition','begin_stock','out_stock','end_stock','unit','price','year','photo','description','status','category_id','sub_category_id','group_id','location_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class,'sub_category_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
