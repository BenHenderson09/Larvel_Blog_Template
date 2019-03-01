@extends('layouts.foundation')

@section('content')
    <div class="container">
        <div class="top-buffer">
            <h1 class="display-4"> Edit Post </h1>
            <hr>
        </div>

        <!-- HTML only supports get and post, spoof this with the _method variable -->
        <form method="POST" action="/posts/{{ $post['id'] }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input name="_method" type="hidden" value="PUT">

            <div class="form-group">
                <label>Title:</label>
                <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 placeholder="My Amazing Post..." name="title" value="{{ $post['title'] }}">
            </div>

            <div class="form-group">
                <label>Body:</label>
                <textarea class="form-control" id="article-ckeditor" rows="10" 
                placeholder="Post Content..." name="body">{{ $post['body'] }}</textarea>
            </div>

            <div class="form-group">
                <input type="file" name="cover_image" accepts="image/*">
                <br/>
                <small>Changing this will overwrite the previous image</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection