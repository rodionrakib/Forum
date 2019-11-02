@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">Threads</div>
                    <div class="card-body">
                        <article>
                            @foreach($threads as $thread)
                                <a href="{{$thread->path()}}">  <h3> {{ $thread->title  }} </h3></a>
                                <p> {{  $thread->replies_count }} {{Str::plural('reply',$thread->replies_count )}},
                                    posted by <a href="#">{{$thread->creator->name }}</a> </p>
                                <div>{{$thread->body}}</div>
                            @endforeach
                        </article>
                    </div>
                </div>
                <div class="col-md-4">
                Side
                </div>
            </div>
        </div>
    </div>
@endsection
