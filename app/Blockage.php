<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Blockage extends Model
{
    //
    protected $fillable = [
        'blk_id',
        'blk_code',
        'blk_location_id',
        'river_id',
        'blk_crossection_id',
        'sol_id',
        'blk_user_id',
        'blk_length_type',
        'blk_length',
        'damage_type',
        'damage_level',
        'damage_frequency',
        'blk_surface',
        'blk_surface_detail',
        'proj_id',
        'blk_user_name',
        'blk_slope_bed'
    ];

    public function blockageLocation() {
        return $this->hasOne('App\BlockageLocation', 'blk_location_id', 'blk_location_id');
    }
    public function blockageCrossection() {
        return $this->hasOne('App\BlockageCrossection', 'blk_xsection_id', 'blk_crossection_id');
    }
    public function River() {
        return $this->hasOne('App\River', 'river_id', 'river_id');
    }
    public function Solution() {
        return $this->hasMany('App\Solution', 'sol_id', 'sol_id');
    }
    public function Photo() {
        return $this->hasMany('App\Photo', 'blk_id', 'blk_id');
    }

    public function User() {
        return $this->hasMany('App\User', 'id', 'blk_user_id');
    }

    public function ProblemDetail() {
        return $this->hasMany('App\ProblemDetail', 'blk_id', 'blk_id');
    }

    public static function getBlockage($blk_id=0){
        $value=DB::table('blockages')->where('blk_id', $blk_id)->distinct()->get();
        return $value;
    }


}
