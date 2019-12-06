<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cnic extends Model
{

    public $table = 'cnic';


    protected $fillable = [
        'user_id ',
        'subservice_id',
        'cnic_front',
        'cnic_back',

    ];


    public $timestamps = false;

}
