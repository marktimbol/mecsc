<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'name', 'designation', 'company', 'about'
    ];

}
