@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style = "font-size:20px; padding-top:15px">
                    Statistics
                </div>

                <div class="card-body" style = "font-size:20px; padding-top:40px">
                    <div class = "row">
                        <div class = "col-6">
                            <form action = "{{ route('statistics') }}" method = "POST">
                                @csrf
                                <div class = "row">
                                    <div class = "col">
                                        <label for = "latInput">Enter latitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" name = "latInput" step = "0.1" id = "latInput" class = "form-control-sm" value = 0 min = -90 max = 90 required>
                                    </div>
                                </div>
                                <br>
                                <div class = "row">
                                    <div class = "col">
                                        <label for = "lonInput">Enter longitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" name = "lonInput" step = "0.1" id = "lonInput" class = "form-control-sm" value = 0 min = -180 max = 180 required>
                                    </div>
                                </div>
                                <div style = "padding-left:100px; padding-top:20px">
                                    <input type = "submit" class = "btn btn-primary btn-sm" value = "Get statistics"> 
                                </div>
                            </form>
                        </div>
                        @if(session()->exists('temp'))
                        <div class = "col">
                            <div style = "text-align:center">
                                <b>City:</b><br>
                                {{ Session::pull('city') }}<br>
                                <b>Last request:</b><br>   
                                @if(session()->exists('requestNotFound') && strcmp(session()->get('entryNotFound'), 'true') == 0)
                                    Never<br>
                                    (Last request date auto-set to 2020-01-01)<br>
                                @else  
                                    {{ Session::pull('lastRequest') }}<br>      
                                @endif
                                <b>Avg. temperature:</b><br>
                                {{ Session::pull('temp') }}
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class = "d-flex justify-content-center" style = "padding-top: 50px">
                        <a href = "{{ route('home') }}">
                            <button class = "btn btn-danger">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection