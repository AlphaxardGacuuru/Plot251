@extends('layouts/app')

@section('content')
@php
    use App\WaterReadings;
    use App\WaterPayments;
@endphp
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center>
            <h1 style="color: #209CEE;">Plot 251 Management</h1>
            @auth
                <h2>Water Bill</h2>
                <h3>
                    <a href="/water-readings/{{ $monthNum + 1 }}" class="btn btn-success rounded-0 float-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                        <span>prev</span>
                    </a>
                    {{ $month }}
                    <a href="/water-readings/{{ $monthNum - 1 }}" class="btn btn-success rounded-0 float-right">
                        <span>next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </a>
                </h3>
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
                            @foreach($users as $user)
                                @php
                                    /* Get units used per apartment */
                                    $lastReading = WaterReadings::where('apartment', $user->apartment)
                                    ->where('created_at', 'like', '%' . $lastMonth . '%')->first();
                                    $lastReading2 = WaterReadings::where('apartment', $user->apartment)
                                    ->where('created_at', 'like', '%' . $lastMonth2 . '%')->first();
                                    $units = $lastReading->reading - $lastReading2->reading;
                                    /* Get water payments per apartment */
                                    $waterPayment = WaterPayments::where('apartment', $user->apartment)
                                    ->where('created_at', 'like', '%' . $lastMonth . '%')->first();
                                @endphp
                                <tr>
                                    <td>{{ $user->apartment }}</td>
                                    <td><a href="/water/{{ $user->apartment }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $units }}</td>
                                    <td class="text-primary">{{ $units*1000 }}</td>
                                    <td class="text-success">KES {{ $units*100 }}</td>
                                    @if($waterPayment)
                                        <td class="text-success">KES {{ $waterPayment->amount }}</td>
                                        <td class="text-success"></td>
                                    @else
                                        <td class="text-danger">KES 0</td>
                                        <td>
                                            {!!Form::open(["action" => "SMSController@store", "method" => "POST"])!!}
                                            {{ Form::hidden('apartment', $user->apartment) }}
                                            {{ Form::hidden('phone', $user->phone) }}
                                            {{ Form::hidden('bill', $units * 100) }}
                                            {{ Form::submit('Send', ['class' => 'btn btn-sm btn-success rounded-0']) }}
                                            {!!Form::close()!!}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td>Totals</td>
                                <td></td>
                                <td></td>
                                <td>{{ $totalUnits }}</td>
                                <td class="text-primary">{{ $totalUnits*1000 }}</td>
                                <td class="text-success">KES {{ $totalUnits*100 }}</td>
                                <td class="text-success">KES {{ $totalPayments }}</td>
                            </tr>
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
