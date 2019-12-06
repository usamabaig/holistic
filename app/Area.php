<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    public $table = 'areas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lat',
        'lng',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }
}
