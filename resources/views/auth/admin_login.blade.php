<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cholo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main class="py-4">
        <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @endauth
    </div>
    @endif
    <div class="content">
        <div class="title m-b-md">Admin Panel</div>
        <div class="form">
            <div class="login-form">
                <form  method="POST" action="{{ route('admin.login.submit') }}">
                {{csrf_field()}}
                    <h2 class="text-center">Log in</h2>       
                    <div class="form-group">
                        <input id="IdentityNumber" type="text" class="form-control" name="email" v required autofocus>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </div>       
                </form>
            </div>
        </div>
    </div>
</div>
        </main>
    </div>
</body>
</html>
