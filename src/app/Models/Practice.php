<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    //
    protected $fillable = [
        'title',
        'is_completed',
        'description'
        
    ];
}
