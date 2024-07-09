<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemDetail extends Model
{
    protected $fillable = [
        'prob_id',
        'blk_id',
        'prob_level',
        'nat_erosion',
        'nat_shoal',
        'nat_missing',
        'nat_winding',
        'nat_weed',
        'nat_weed_detail',
        'nat_other',
        'nat_other_detail',
        'hum_structure',
        'hum_str_owner_type',
        'hum_stc_bld_num',
        'hum_stc_fence_num',
        'hum_str_other',
        'hum_stc_bld_bu_num',
        'hum_stc_fence_bu_num',
        'hum_str_other_bu',
        'hum_road',
        'hum_smallconvert',
        'hum_road_paralel',
        'hum_replaced_convert',
        'hum_bridge_pile',
        'hum_soil_cover',
        'hum_trash',
        'hum_other',
        'hum_other_detail',
        'created_at',
        'updated_at'
    ];

    public function blockage() {
        return $this->hasOne('App\Blockage', 'blk_id', 'blk_id');
    }
}
