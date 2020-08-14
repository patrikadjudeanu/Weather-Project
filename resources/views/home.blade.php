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
                    <div>
                        <b>Your current location:</b>
                    </div>
                    <div>
                        <!-- GEOLOCATION API -->
                        TODO GEO API
                    </div>
                    <div class = "row"   style = "padding-top:10px">
                        <div class = "col">
                            <div>
                                <b>Current temperature:</b>
                            </div>
                            <div>
                                <!-- WEAHER API -->
                                TODO WEATHER API
                            </div>
                        </div>
                        <div class = "col">
                            <div>
                                Updated at:
                                <!-- WEATHER API UPDATE TIMESTAMP -->TODO Timestamp
                            </div>
                            <div>
                                <button class = "btn btn-info btn-sm" id = "resetCurWeatherBtn">Reset</button>
                            </div>
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
