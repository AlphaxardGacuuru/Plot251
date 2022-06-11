@extends('layouts/app')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center>
            <h1 style="color: #209CEE;">Plot 251 Management</h1>
            @auth
                <h2 class="text-primary">Water Bill</h2>
                <h4 class="text-primary">{{ $month }}</h4>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/water-readings/{{ $monthNum + 1 }}"
                            class="btn btn-primary rounded-0 float-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                            </svg>
                            <span>prev</span>
                        </a>
                    </div>
                    <div>
                        <a href="/water-readings/{{ $monthNum - 1 }}" class="btn btn-primary rounded-0 float-right">
                            <span>next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                        </d>
                    </div>
                </div>
                <br>
                @if($lastReadingTot2 > 0 && $lastReadingTot > 0)
                    <div class="overflow-auto">
                        <table class="table table-hover">
                            <tr>
                                <th>Apartment</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Units</th>
                                <th class="text-primary">Litres</th>
                                <th class="text-success">Bill</th>
                                <th class="text-success">Paid</th>
                                <th class="text-success">SMS</th>
                            </tr>
                            @foreach($apartments as $apartment)
                                @if($apartment['apartment']
                                    == Auth::user()->apartment
                                    || Auth::user()->name == "Admin")
                                    <tr>
                                        <td>{{ $apartment['apartment'] }}</td>
                                        <td>{{ $apartment['name'] }}</td>
                                        <td>{{ $apartment['phone'] }}</td>
                                        <td>{{ $apartment['units'] }}</td>
                                        <td class="text-primary">{{ $apartment['litres'] }}</td>
                                        <td class="text-success">KES {{ $apartment['bill'] }}
                                        </td>
                                        @if(!$apartment['balance'])
                                            <td class="text-success">
                                                KES {{ $apartment['paid'] }}
                                            </td>
                                            <td class="text-success"></td>
                                        @else
                                            <td class="text-danger">
                                                KES {{ $apartment['paid'] }}
                                            </td>
                                            <td>
                                                @if(Auth::user()
                                                    ->name == "Admin")
                                                    {!!Form::open([
                                                    "action" => "SMSController@store",
                                                    "method" => "POST"
                                                    ])!!}
                                                    {{ Form::hidden('apartment', $apartment['apartment']) }}
                                                    {{ Form::hidden('phone', $apartment['userPhone']) }}
                                                    {{ Form::hidden('balance', $apartment['balance']) }}
                                                    {{ Form::submit('Send', ['class' => 'btn btn-sm btn-success rounded-0']) }}
                                                    {!!Form::close()!!}
                                                @else
                                                    {!!Form::open([
                                                    "action" => "WaterPaymentsController@store",
                                                    "method" => "POST"
                                                    ])!!}
                                                    {{ Form::hidden('apartment', $apartment['apartment']) }}
                                                    {{ Form::hidden('phone', $apartment['userPhone']) }}
                                                    {{ Form::hidden('bill', $apartment['bill']) }}
                                                    {{ Form::submit('Pay', ['class' => 'btn btn-sm btn-success rounded-0']) }}
                                                    {!!Form::close()!!}
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                            @if($apartment['apartment']
                                == Auth::user()->apartment
                                || Auth::user()->name == "Admin")
                                <tr class="font-weight-bold">
                                    <td>Totals</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $totalUnits }}</td>
                                    <td class="text-primary">{{ $totalLitres }}</td>
                                    <td class="text-success">KES {{ $totalBill }}</td>
                                    <td class="text-success">KES {{ $totalPayments }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <br>
                    @if($lastReadingTot3 > 0)
                        {{-- Progress Bar --}}
                        <div class="progress rounded-0">
                            <div class="progress-bar bg-{{ $class }}" style="width:10%">{{ $proportion }} %</div>
                        </div>
                        <br>
                        <h5 class="text-{{ $class }}">{{ $moreOrLess }}</h5>
                    @else
                        <h5 class="text-primary">Nothing to show</h5>
                    @endif
                @else
                    <h5 class="text-primary">Nothing to show</h5>
                @endif
            @endauth
        </center>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection
