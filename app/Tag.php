<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $appends = ['link'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getLinkAttribute()
    {
        return "<a href='" . route('tags.show', $this) . "'>" . $this->name . "</a>";
    }
}
