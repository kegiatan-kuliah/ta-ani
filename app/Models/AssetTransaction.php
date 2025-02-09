<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetTransaction extends Model
{
    protected $table = 'asset_transactions';

    protected $fillable = [
        'out_date','return_date','due_date','out_photo','return_photo','application_id'
    ];
}
