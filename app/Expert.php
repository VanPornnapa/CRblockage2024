<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'blk_id',
        'blk_code',
        'exp_problem',
        'exp_area',
        'exp_L0',
        'exp_H',
        'exp_C',
        'exp_tc',
        'exp_returnPeriod',
        'exp_I',
        'exp_maxflow',
        'exp_solution',
        'exp_slope',
        'exp_pixmap',
        'exp_pix1',
        'exp_pix2',
        'created_at',
        'updated_at'

    ];
}
