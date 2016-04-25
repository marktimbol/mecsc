<?php

namespace App;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
	use AlgoliaEloquentTrait;

    protected $fillable = [
        'name', 'designation', 'company', 'about'
    ];

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    public $indices = ['mecsc_speakers'];
}
