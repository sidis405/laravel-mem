<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Accessors = Getters - modifica il dato prima di essere presentato
    public function getNameAttribute($name)
    {
        return $name;
    }

    // Mutators = Setters - modifca il dato prima di essere persistito in database
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }
}
