<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationItem extends Model
{
    protected $table = 'application_items';

    protected $fillable = ['name','unit','quantity','application_id'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
