<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'name','identity_no','member_no','gender','phone_no','address','photo','user_id'
    ];
}
