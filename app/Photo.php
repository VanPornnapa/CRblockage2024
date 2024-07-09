<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_id', 
                            'blk_id',
                            'photo_type',
                            'photo_name',
                            'thumbnail_name',
                            'photo_detail',
                            'created_at',
                            'updated_at'];
}
