<!DOCTYPE html>
<html>
<head>
    <title>Routine Generator</title>
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
            <a class="navbar-brand" href="{{route('admin.home')}}">Cholo</a>
        </div>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto">
                <li><a href="{{route('admin.transport')}}">Transports</a></li>
                <li><a href="{{route('admin.station')}}">Stations</a>
                <li><a href="{{route('admin.route')}}">Routes</a></li>
                <li><a href="{{route('admin.feedback')}}">Feedbacks</a>
                <li style="display:none;"><a href="{{route('admin.information')}}">Informations</a></li>
                <li><a href="{{route('admin.user')}}">Users</a></li>
                @if(Auth::check())
                <li>
                    <a href="{{route('logout')}}" class="" onclick="event.preventDefault();document.getElementById('lo').submit();">Logout</a>
                    <form action="{{route('logout')}}" method="post" id="lo" style="display:none">
                        {{csrf_field()}}
                    </form>
                </li>
                @endif 
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