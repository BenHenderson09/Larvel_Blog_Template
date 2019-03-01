@extends('layouts.foundation')

@section('content')
    @if(!empty($post))
        <div class="box-body">
            <div class="heading text-center">
                <h1> {{ $post['title'] }}</h1>
                <hr>
            </div>

            <div class="body top-buffer">
                    {!!$post['body']!!}
            </div>

            <div class="info">
                Written by: {{ $post->user['username'] }} at {{ $post['created_at'] }}

                &nbsp;&nbsp;

                @if(Auth::check() && auth()->user()->id == $post->user_id)
                    <div class="btn-group" role="group">
                        <a href="/posts/{{$post['id']}}/edit"> <button type="button" class="btn btn-outline-primary"> Edit </button></a> &nbsp;
                        
                        <form method="POST" action="/posts/{{$post['id']}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"> Delete </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection