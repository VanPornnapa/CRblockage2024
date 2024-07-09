<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
       'sol_id',
       'proj_id',
       'responsed_dept',
       'sol_how',
       'result',
       'created_at',
       'created_at',
       'sol_edit'
    ];

    public function Project() {
        return $this->hasMany('App\Project', 'proj_id', 'proj_id');
    }

    public function Blockage() {
        return $this->belongTo('App\Blockage', 'sol_id', 'sol_id');
    }
}
