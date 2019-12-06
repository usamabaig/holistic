<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderFooter extends Model
{

    protected $table = 'header_footer';

    protected $fillable = ['address', 'timing', 'email', 'phone_no' ,'fax' , 'facebook' , 'twitter' , 'insta' , 'youtube'];

    public $timestamps = false;
}
