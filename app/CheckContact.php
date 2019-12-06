<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckContact extends Model
{

    public $table = 'contact';

    protected $fillable = [
        'name',
        'date',
        'address',
        'city',
        'country',
        'status',
        'service_name',
        'subservice_id',
        'charges',
        'order_person_name',
        'quantity',

    ];
}
