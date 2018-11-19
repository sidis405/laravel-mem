<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $casts = ['mio_campo_data' => 'datetime'];

    // protected $fillable = ['title', 'user_id', 'category_id', 'preview', 'body'];
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);// new-snipped-fork-152
    }

    public function isAuthoredBy(User $user)
    {
        return $user->id == $this->user_id;
    }
}
