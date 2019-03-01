@extends('layouts.foundation')

@section('content')
    <div class="container">

        <div class="top-buffer">
            <h1 class="display-4"> Posts </h1>
            <hr>
        </div>

        @if(!empty($posts) && count($posts) > 0)
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
            <br/>
            {{ $posts->links() }}
        @endif
    </div>
@endsection