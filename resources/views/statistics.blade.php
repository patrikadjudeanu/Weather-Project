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
                                <div class = "row">
                                    <div class = "col">
                                        <label for = "latInput">Enter latitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" name = "latInput" step = "0.1" id = "latInput" class = "form-control-sm" value = "0">
                                    </div>
                                </div>
                                <br>
                                <div class = "row">
                                    <div class = "col">
                                        <label for = "lonInput">Enter longitude:</label>
                                    </div>
                                    <div class = "col">
                                        <input type = "number" name = "lonInput" step = "0.1" id = "lonInput" class = "form-control-sm" value = "0">
                                    </div>
                                </div>
                                <div style = "padding-left:100px; padding-top:20px">
                                    <input type = "submit" class = "btn btn-primary btn-sm" value = "Get statistics" onClick = "getStatistics()"> 
                                </div>
                        </div>
                        <div class = "col" style = "text-align:center; padding-top:20px" id = "resultDiv">

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

<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
</script>
<script>
    function getStatistics(){
        $.ajax({
            type:"POST",
            url:"{{ route('getStatistics') }}",
            dataType: "json",
            data:{
                latInput: $('#latInput').val(),
                lonInput: $('#lonInput').val(),
                _token: "{{ csrf_token() }}"
            }
        })
        .done(function(data){
            if(data.error){
                $('#resultDiv').html("<b>Error</b><br>Could not retrieve data.");
            }
            else{
                $('#resultDiv').html("<b>City:</b><br>" + data.city + "<br><b>Temperature:</b><br>" + data.temp + "<br><b>From date:</b><br>" + data.from);
            }
        })
    }
</script>
@endsection