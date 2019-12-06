<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';

    protected $fillable = ['image', 'thumbnail', 'title', 'description' ,'status'];


}
