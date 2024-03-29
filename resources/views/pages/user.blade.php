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
                        <td>
                            <a href="/apartments/{{ $apartment->apartment }}/edit"
                               class="btn mysonar-btn">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </center>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection
