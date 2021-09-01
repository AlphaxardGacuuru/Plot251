@extends('layouts/app')
@section('content')
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
		<center><h1>SMS Status</h1></center>
        <table class="table table-hover table-responsive">
            <tr>
                <th class="text-primary">Apartment</th>
                <th>Number</th>
                <th>Status</th>
                <th>Status Code</th>
                <th class="text-success">Cost</th>
                <th>Delivery Status</th>
                <th>Network Code</th>
                <th>Failure Reason</th>
                <th>Date Sent</th>
            </tr>
            @foreach($sms as $key => $item)
                <tr>
                    <td class="text-primary"><b>{{ $item['apartment'] }}</b></td>
                    <td>{{ $item['number'] }}</td>
                    <td
                        class={{ $item['status'] == "Success" ? "text-success" : "text-danger" }}>
                        {{ $item['status'] }}</td>
                    <td>{{ $item['statusCode'] }}</td>
                    <td class="text-success">{{ $item['cost'] }}</td>
                    <td
                        class={{ $item['deliveryStatus'] == "Success" ? "text-success" : "text-danger" }}>
                        {{ $item['deliveryStatus'] }}
                    </td>
                    <td>{{ $item['networkCode'] }}</td>
                    <td><b>{{ $item['failureReason'] }}</b></td>
                    <td>{{ $item['sent'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-sm-1"></div>
</div>
@endsection
