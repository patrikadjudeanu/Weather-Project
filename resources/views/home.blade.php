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
                    <div class = "d-flex justify-content-center">
                        <b>Choose what to do:</b>
                    </div>
                    <div style = "padding-top: 35px; padding-right:35px" class = "row">
                        <div class="col-md-3 offset-md-3">
                            <a class = "btn btn-primary" href = "{{ route('temperature') }}">
                                Get temperatures
                            </a>
                        </div>
                        <div class="col-md-3 offset-md-1">
                            <a class = "btn btn-primary" href = "{{ route('statistics') }}">
                                Get statistics
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
