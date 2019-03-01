@extends('layouts.foundation')

@section('content')
    <div class="container">
        <div class="top-buffer">
            <h1 class="display-4"> Posts </h1>
            <hr>
        </div>

        <form method="POST" action="/posts" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label>Title:</label>
                <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 placeholder="My Amazing Post..." name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label>Body:</label>
                <textarea class="form-control" id="article-ckeditor" rows="10" 
                placeholder="Post Content..." name="body">{{ old('body') }}</textarea>
            </div>

            <div class="form-group">
                <input type="file" name="cover_image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection