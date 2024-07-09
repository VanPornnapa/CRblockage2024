<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Form extends Model
{
    use SpatialTrait;
    protected $table = "form";
    
    protected $fillable = [
      'startLocation',
      'finishLocation'  
    ];

    protected $spatialFields = [
        'startLocation',
        'finishLocation' 
    ];
}
