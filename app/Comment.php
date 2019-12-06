<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    public $table = 'comments';



    // public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subservice_id',
        'comment',

    ];


}
