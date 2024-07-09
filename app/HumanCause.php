<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HumanCause extends Model
{
    protected $fillable = [
        'hum_cause_id',
        'human_cause_type',
        'bld_type',
        'bld_amount',
        'road_detail',
        'road_percent',
        'culvert_detail',
        'culvert_percent',
        'bridge_detail',
        'trash_detail',
        'other_detail',
        'created_at',
        'updated_at'

    ];
}
