@extends('layouts/app')

@section('content')

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center>
            <table class="table">
                <tr>
                    <th>Apartment</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
                @foreach($users as $apartment)
                    <tr>
                        <td>{{ $apartment->apartment }}</td>
                        <td>{{ $apartment->name }}</td>
                        <td>{{ $apartment->phone }}</td>
                        <td><a href="/apartments/edit" class="btn btn-sm btn-primary rounded-0">Edit</a></td>
                        <td>
                            {{ Form::open() }}
                            {{ Form::hidden('apartment', $apartment->apartment) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </center>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection
