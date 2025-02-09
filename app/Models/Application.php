<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'application_no','date','approval_date','photo','total_quantity','status','requestor_id','purpose'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'requestor_id');
    }

    public function items()
    {
        return $this->hasMany(ApplicationItem::class, 'application_id');
    }

    public function generateApplicationNo()
    {
        $latest = $this->latest('id')->first(); // Get the latest record
        $sequence = $latest ? str_pad($latest->id + 1, 3, '0', STR_PAD_LEFT) : '001';
    
        return "{$sequence}/SMKN 1 SolSel/Inven/".date('Y');
    }
}
