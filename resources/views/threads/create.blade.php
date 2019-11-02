@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <form method="POST" action="/threads">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select Channel</label>
                                <select  name="channel_id" class="form-control" id="exampleFormControlSelect2">
                                    <option value="" >Choose One</option>
                                    @foreach(\App\Channel::all() as $channel)
                                    <option value="{{$channel->id}}" >{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="" placeholder="Title of Thread">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Thread Body</label>
                                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
