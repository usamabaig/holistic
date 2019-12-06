<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use willvincent\Rateable\Rateable;



class SubService extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;
    use Rateable;

    public $table = 'sub_services';

    protected $appends = [
        'picture',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'charges',
        'is_women',
        'why_use_us',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'how_it_work',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function services()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function getPictureAttribute()
    {
        $files = $this->getMedia('picture');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }
}
