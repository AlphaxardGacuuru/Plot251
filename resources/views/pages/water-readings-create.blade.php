@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <h2>Hello Sir!</h2>
            <h4>How much water's been used?</h4>
            {!!Form::open(["action" => "WaterReadingsController@store", "method" => "POST"])!!}
            <br>
            {{ Form::number('F1', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 1', 'required']) }}
            <br>
            {{ Form::number('F2', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 2', 'required']) }}
            <br>
            {{ Form::number('F3', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 3', 'required']) }}
            <br>
            {{ Form::number('F4', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 4', 'required']) }}
            <br>
            {{ Form::number('F5', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 5', 'required']) }}
            <br>
            {{ Form::number('F6', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 6', 'required']) }}
            <br>
            {{ Form::number('F7', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 7', 'required']) }}
            <br>
            {{ Form::number('F8', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 8', 'required']) }}
            <br>
            {{ Form::number('F9', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Flat 9', 'required']) }}
            <br>
            {{ Form::submit('Save', ['class' => 'rounded-0 btn btn-primary']) }}
            {!!Form::close()!!}
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
