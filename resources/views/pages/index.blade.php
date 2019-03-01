@extends('layouts.foundation')

@section('content')
    <div class="container top-buffer">
        <div class="jumbotron text-center txt-grey">
            <h1 class="header"> Welcome To The Blog! </h1>
            <h4> This is a little piece of irrelevant text. </h4>

            <hr>

            <div class="btn-nav row top-buffer-large">
                <div class="col-">
                    <a href="/posts" class="btn btn-outline-success btn-lg"> Explore </a>
                </div>

                @if(Auth::check())
                    <div class="col-">
                        <a href="/posts/create" class="btn btn-outline-primary btn-lg"> Create </a>
                    </div>
                @else
                    <div class="col-">
                        <a href="/register" class="btn btn-outline-primary btn-lg"> Join </a>                    
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection