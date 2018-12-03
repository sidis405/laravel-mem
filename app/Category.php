<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait;

    protected $appends = ['link'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getLinkAttribute()
    {
        return route('categories.show', $this);
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
