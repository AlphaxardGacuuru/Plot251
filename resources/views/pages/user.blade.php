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
            <h1>Plot 251 Management</h1>
            @auth
                <h2>Water Bill</h2>
                <h3>
                    <a href="/apartment/{{ $monthNum + 1 }}" class="btn btn-success rounded-0 float-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                        <span>prev</span>
                    </a>
                    {{ $month }}
                    <a href="/apartment/{{ $monthNum - 1 }}" class="btn btn-success rounded-0 float-right">
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
                            </tr>
                            {{-- Get units used per Apartment --}}
                            @php
                                $lastReading = WaterReadings::where('apartment', Auth::user()->apartment)
                                ->where('created_at', 'like', '%' . $lastMonth . '%')->first();
                                $lastReading2 = WaterReadings::where('apartment', Auth::user()->apartment)
                                ->where('created_at', 'like', '%' . $lastMonth2 . '%')->first();
                                $units = $lastReading->reading - $lastReading2->reading;
                                /* Get water payments per apartment */
                                $waterPayment = WaterPayments::where('apartment', Auth::user()->apartment)
                                ->where('created_at', 'like', '%' . $lastMonth . '%')->first();
                            @endphp
                            <tr>
                                <td>{{ Auth::user()->apartment }}</td>
                                <td><a href="/water/{{ Auth::user()->apartment }}">{{ Auth::user()->name }}</a>
                                </td>
                                <td>{{ Auth::user()->phone }}</td>
                                <td>{{ $units }}</td>
                                <td class="text-primary">{{ $units*1000 }}</td>
                                <td class="text-success">KES {{ $units*100 }}</td>
                                @if($waterPayment)
                                    <td class="text-success">KES {{ $waterPayment->amount }}</td>
                                @else
                                    <td class="text-danger">KES 0</td>
                                @endif
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
