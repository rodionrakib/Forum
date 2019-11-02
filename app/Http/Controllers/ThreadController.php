<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     * @param \App\Channel
     * @param Request
     * @return Response
     */
    public function index(Request $request, Channel $channel)
    {

        $threads = $this->getThreads($channel,$request);

        if($request->wantsJson()){
            return $threads;
        }
        return view('threads.index',[ 'threads'=> $threads ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attr = $request->validate([
            'title' => 'required|unique:threads|max:255',
            'body' => 'required',
            'channel_id' => 'required'
        ]);

        $attr['user_id'] = auth()->id();

        $thread = Thread::create($attr);

        return redirect($thread->path());

    }

    /**
     * Display the specified resource.
     * @param \App\Channel $channel
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel,Thread $thread)
    {

        return view('threads.show',['thread'=> $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }

    protected function getDefaultThreads()
    {
        return Thread::all();
    }

    protected function getThreads($channel,$request)
    {
        if($channel->exists){
            $threads = $channel->threads()->latest();
        }
        else{
            $threads = Thread::latest();
        }


        if($name = $request->get('by')){
            $threads = User::where('name',$name)->firstOrFail()->threads()->latest();
        }

        if($request->get('popularity')){
            $threads = Thread::orderBy('replies_count','desc');
        }

        return $threads->get();

    }

    protected function getByPopularity($name)
    {


    }
}
