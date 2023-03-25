<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Record extends Model
{
    use HasFactory;

    public $guarded = [];


    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
