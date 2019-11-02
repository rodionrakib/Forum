<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function path()
    {
        return 'threads/'.$this->slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
