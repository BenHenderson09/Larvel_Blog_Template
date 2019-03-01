<div class="container top-buffer">

<!-- `$errors` is a Laravel variable set from the validate function in the controller -->
@if (count($errors) > 0)
    <!-- `$errors->all()` converts the json message to an array -->
    @foreach ($errors->all() as $error)

        <div class="alert alert-danger">
            {{ $error }}
        </div>

    @endforeach
@endif

<!-- Session messages are set by the programmer -->
@if (!empty(session('success')))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>    
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>    
@endif

</div>