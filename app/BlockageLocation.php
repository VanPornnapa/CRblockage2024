<?php

namespace App;
use App\River;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class BlockageLocation extends Model
{
    use SpatialTrait;
    // protected $primaryKey = 'blk_location_id';

    protected $fillable = [
        'blk_location_id',
        'blk_start_location',
        'blk_end_location',
        'blk_village',
        'blk_tumbol',
        'blk_district',
        'blk_province',
        'created_at',
        'updated_at',
        'blk_start_utm',
        'blk_end_utm',
        'code_vill'

      ];
      protected $spatialFields = [
        'blk_start_location',
        'blk_end_location' ,
        'blk_start_utm',
        'blk_end_utm'
      
      ];
    
    public function user() {
        return $this->belongsToMany('App\Blockage');
    }  

    public function Blockage() {
      
      return $this->hasOne('App\Blockage', 'blk_location_id', 'blk_location_id');
    }

    // public function River() {
    //   return $this->hasOne('App\Blockage', 'App\River', 'river_id', 'river_id');
    // }

    // public function ProblemDetail() {
    //   return $this->belongsToMany('Blockage', 'ProblemDetail', 'blk_id', 'blk_id');
    // }

}
