<!DOCTYPE HTML>
<html>
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> {{ config('app.name', 'Blog') }} </title>  <!-- .env variable, if not set, return `Blog`. Or $_ENV['yourkey'] -->

        <!-- CSS (includes bootstrap) -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body>
        @include('includes.nav')
        @include('includes.messages')
        
        <div class="txt-grey">
            @yield('content')
        </div>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('article-ckeditor');
        </script>
    </body>
</html>
