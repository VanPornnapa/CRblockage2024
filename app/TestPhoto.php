<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPhoto extends Model
{
    protected $table = 'testphotos';
    protected $fillable = ['image', 'thumbnail'];
}
