@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style = "font-size:20px; padding-top:15px">
                    Get temperature
                </div>

                <div class="card-body" style = "font-size:20px; padding-top:40px">
                    <div class = "row">
                        <div class = "col">
                            <form>
                                @csrf
                                <div class = "row">
                                    <div class = "col-3">
                                        <label for = "latInput">Enter latitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" step = "0.1" id = "latInput" class = "form-control-sm">
                                    </div>
                                </div>
                                <br>
                                <div class = "row">
                                    <div class = "col-3">
                                        <label for = "lonInput">Enter longitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" step = "0.1" id = "lonInput" class = "form-control-sm">
                                    </div>
                                </div>
                                <div style = "padding-left:100px; padding-top:20px">
                                    <input type = "submit" class = "btn btn-primary btn-sm" value = "Get temperature"> 
                                </div>
                            </form>
                        </div>
                        <div class = "col">
                            City:
                            
                            Temperature:
                            
                        </div>
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