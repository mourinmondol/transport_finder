<!DOCTYPE html>
<html>
<head>
    <title>Cholo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    @yield('stylesheet')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/stars.css')}}">
    <style>
        .container {
            width: 100%;
        }    
    </style>
    
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">Cholo</a>
        </div>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto">
                <li><a href="{{route('user.transport')}}">Transports</a></li>
                <li><a href="{{route('user.station')}}">Stations</a>
                <li><a href="{{route('user.route')}}">Routes</a></li>
                <li><a href="{{route('user.feedback')}}">Feedbacks</a>
                <li><a href="{{route('user.profile')}}">My Account</a></li>
                @if(Auth::check())
                <li>
                    <a href="{{route('logout')}}" class="" onclick="event.preventDefault();document.getElementById('lo').submit();">Logout</a>
                    <form action="{{route('logout')}}" method="post" id="lo" style="display:none">
                        {{csrf_field()}}
                    </form>
                </li>
                @endif 
                <li><a href="{{url('/')}}">View Site</a></li>
            </ul>
    </div>
    </nav>
</div>
<div class="wrap">
        @yield('body')
</div>
    <!-- Javascripts -->
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif

        @if(Session::has('alert'))
        toastr.error("{{Session::get('alert')}}")
        @endif

        @if(count($errors) > 0)

        @foreach($errors->all() as $error)
        toastr.error("{{ $error }}")
        @endforeach

        @endif
    </script>

    @yield('javascript')
</body>
</html>