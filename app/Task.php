<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function scopeIncomplete($query)
    {
        return $query->whereCompleted(false);
    }

    public function scopeCompleted($query)
    {
        return $query->whereCompleted(true);
    }
}
