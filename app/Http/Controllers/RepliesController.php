<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request,$channel,Thread $thread)
    {


        // validation in future
        $data = $request->validate(['body' => 'required']);

        $data['user_id'] = auth()->id();



        $thread->addReply($data);

        return back();
    }
}
