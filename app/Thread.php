<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Thread extends Model
{
    protected $guarded = [];


    protected $withCount = [
        'replies'
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }



    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->save(new Reply($reply));

    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function path()
    {
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }
}
