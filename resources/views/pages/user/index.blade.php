@extends('layouts.foundation')

@section('content')
    <div class="container">
        <div class="top-buffer">
            <h1 class="display-4"> {{ $user['username'] }} : </h1>
            <hr>

            <div class="card">
                <div class="card-header"> User Details </div>
                <form method="POST" action="{{ route('user.update') }}" class="card-body">
                    @csrf

                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ $user['username'] }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user['email'] }}">
                    </div>

                    <div class="form-group">
                        <label for="posts">Posts</label>
                        <input type="text" class="form-control" id="posts" value="{{ count($posts) }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="created">Created</label>
                        <input type="text" class="form-control" id="created" value="{{ $user['created_at'] }}" readonly>
                    </div>

                    <div class="row user-btns">
                        <div class="col-">
                            <button type="submit" class="btn btn-outline-primary"> Update </button>
                        </div> &nbsp;
                    </form>
                    
                    <div class="col-">
                        <form method="POST" action="{{ route('user.destroy') }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-outline-danger" 
                            onclick="return confirm('Are you sure?');">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>

            @if(!empty($posts) && count($posts) > 0)
                <div class="top-buffer-large">
                    <h1 class="display-4"> My Posts : </h1>
                    <hr>

                    <div class="posts">
                            @foreach($posts as $post)
                            <div class="post top-buffer">
                                <div class="box">
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4">
                                                <img style="width:100%" src="{{ asset("storage/cover_images/{$post['cover_image']}") }}">
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                <a href="/posts/{{ $post['id'] }}"><h1 class="box-title"> {{ $post['title'] }}</h1></a>
                                                <p> Written by: {{ $post->user['username'] }} at {{ $post['created_at'] }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection