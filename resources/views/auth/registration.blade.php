<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <h4>Registration</h4>
        <hr>
        <form action="{{route('register-user')}}" method="post">
            @csrf
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="from-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                <br>
                <label for="email">E-Mail</label>
                <input type="text" class="form-control" placeholder="Enter E-Mail" name="email" value="{{ old('email') }}">
                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
            <br>
            <p class="text-center">Already have an account? <a href="login">Login here</a></p>
        </form>
    </div>
</body>
</html>