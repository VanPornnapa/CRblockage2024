<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockageCrossection extends Model
{
    protected $fillable = [
        'blk_xsection_id',
        'blk_id',
        'created_at',
        'updated_at',
        'past',
        'current_start',
        'current_narrow',
        'current_end',
        'current_brigde'

    ];

    public function blockage() {
        return $this->hasOne('App\BlockageCrossection', 'blk_id', 'blk_id');
    }
}
