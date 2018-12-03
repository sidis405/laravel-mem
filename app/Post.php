<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CrudTrait;
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

    public function getCoverAttribute($cover)
    {
        return '/storage/' . ($cover ?? 'covers/default_article_cover.jpg'); // null coalescence operator
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);// new-snipped-fork-152
    }

    // public function setCoverAttribute(UploadedFile $cover)
    // {
    //     $this->attributes['cover']  = $cover->store('covers');
    // }

    public function setCoverAttribute($value)
    {
        $attribute_name = "cover";
        $disk = "public";
        $destination_path = "covers";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }

    public function isAuthoredBy(User $user)
    {
        return $user->id == $this->user_id;
    }
}
