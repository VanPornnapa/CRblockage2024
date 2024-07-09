<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    protected $fillable = [
        'id',
        'river_id',
        'river_name',
        'river_type',
        'river_main',
        'created_at',
        'updated_at'
     ];
     public function Blockage() {
        return $this->hasOne('App\Blockage', 'river_id', 'river_id');
    }

   

}
