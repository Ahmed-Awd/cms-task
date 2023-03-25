<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Attribute extends Model
{
    use HasFactory,HasSlug,SoftDeletes;

    public $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate()
            ->usingSeparator('-');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'attribute_entity', 'attribute_id', 'entity_id');
    }
}
