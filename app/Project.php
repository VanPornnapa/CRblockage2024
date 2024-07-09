<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'proj_id',
        'proj_char',
        'proj_status',
        'proj_budget',
        'proj_year',
        'created_at',
        'updated_at',
     ];

     public function Solution() {
        return $this->belongTo('App\Solution', 'proj_id', 'proj_id');
    }

}
