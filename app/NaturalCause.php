<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaturalCause extends Model
{
    protected $fillable = [
        'nat_cause_id',
        'nat_cause_type',
        'nat_cause_detail',
        'created_at',
        'updated_at'

    ];
}
