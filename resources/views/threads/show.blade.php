@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <article>
                            <p>Thread created by {{ $thread->creator->name  }}</p>
                            <h3> {{ $thread->title  }} </h3>
                            <div>{{$thread->body}}</div>
                        </article>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <p> This Thread is posted by <a href="#"> {{ $thread->creator->name  }} </a>  about {{$thread->created_at->diffForHumans()}} </p>
                </p>This thread has {{$thread->replies()->count()}} {{Str::plural('reply',$thread->replies_count )}}

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Replies</div>

                    <div class="card-body">
                        <div>
                            <h4>Thread Replies</h4>
                            @foreach($thread->replies as $reply)
                                <div class="card-header">
                                    {{$reply->owner->name}} said
                                </div>
                                <div class="card-body">
                                     {{$reply->body}}
                                </div>
                            @endforeach
                        </div>

                        @if(auth()->check())
                            <form method="POST" action="{{$thread->path()}}/replies">
                                @csrf
                                <textarea name="body" placeholder="Have Something to Say">

                                </textarea>
                                <input type="submit" >
                            </form>
                        @else
                            <p>Please <a href="{{route('login')}}" > Login </a>  to add reply</p>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-md-4">


            </div>
        </div>


    </div>
@endsection









