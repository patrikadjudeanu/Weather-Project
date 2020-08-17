@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class = "row justify-content-between">
                        <div style = "padding-left:10px; padding-top:5px; font-size:20px">
                            Hello, {{ Auth::user()->name }}!
                        </div>
                        <div style = "padding-right:10px">
                            <a class = "btn btn-danger" href = "{{ route('logout') }}">
                                Log out
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body" style = "font-size:20px; padding-top:40px">
                    <div class = "row" style = "padding-left: 80px">
                        <div class = "col">
                            <b>Your current location:</b><br>
                            {{ session('currentLocation') }}
                        </div>
                        <div class = "col">
                            <b>Current temperature:</b><br>
                            {{ session('currentTemperature') }}
                        </div>
                    </div>
                    <div style = "padding-top: 35px" class = "row">
                        <div class="col-md-3 offset-md-2">
                            <a class = "btn btn-primary" href = "{{ route('temperature') }}">
                                Get temperatures
                            </a>
                        </div>
                        <div class="col-md-3 offset-md-2">
                            <a class = "btn btn-primary" href = "{{ route('statistics') }}">
                                Statistics
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
