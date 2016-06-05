<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibitor extends Model
{
    protected $fillable = ['name', 'standNumber', 'country', 'website', 'about'];
}
