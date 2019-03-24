@extends('layouts.app')
@section('content')
    <div class="content">
        <form method="GET" action="{{route('search_result')}}" class="searching">
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="input-select">
                        <select data-trigger="" name="type" class="form-control form-control-lg ">
                            <option value="Station">Station</option>
                            <option value="Transport">Transport</option>
                            <option value="Bus">Bus</option>
                            <option value="Train">Train</option>
                            <option value="Boat">Boat</option>
                            <option value="Airplane">Airplane</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="input-field second-wrap">
                    <input class="form-control form-control-lg " name="searchValue" id="search" type="text" placeholder="Enter Keywords?" />
                </div>
                <div class="input-field third-wrap">
                    <button type="submit" class="btn btn-default btn-sd">Search</button>
                </div>
            </div>
        </form>
        <script src="js/extention/choices.js"></script>
        <script>
            const choices = new Choices('[data-trigger]',
            {
                searchEnabled: false,
                itemSelectText: '',
            });
        </script>
    </div>
@endsection
