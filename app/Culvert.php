<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culvert extends Model
{
    protected $fillable = [
        'culvert_id',
        'culvert_type',
        'diameter',
        'culvert_width',
        'culvert_hight',
        'created_at',
        'updated_at'

    ];
}
