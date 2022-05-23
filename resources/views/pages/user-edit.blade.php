@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center>
            <h1>Edit {{ $id }}</h1>
            {{ Form::open(["action" => ["UsersController@update", $id], "method" => "POST"]) }}
            {{ Form::text('name', $apartment->name, ["placeholder" => "Name", "class" => "form-control rounded-0"]) }}
            <br />
            {{ Form::text('email', $apartment->email, ["placeholder" => "Email", "class" => "form-control rounded-0"]) }}
            <br />
            {{ Form::number('phone', $apartment->phone, ["placeholder" => "Phone", "class" => "form-control rounded-0"]) }}
            <br />
            {{ Form::submit("Edit", ["class" => "btn btn-primary rounded-0"]) }}
            {{ Form::close() }}
        </center>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection
