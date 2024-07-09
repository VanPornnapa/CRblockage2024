<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeLogs extends Model
{
    protected $fillable = [

        'log_id',
        'blk_id',
        'user_id',
        'created_at',
        'updated_at',
        'data_old',
        'data_new'

    ];

    public function blockage() {
        return $this->hasOne('App\ChangeLogs', 'blk_user_id', 'user_id');
    }
}
