<?php

namespace App\Http\Controllers;

use App\User;
use App\WaterPayments;
use App\WaterReadings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WaterReadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('water-readings/0');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/water-readings-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'F1' => 'required',
        ]);

        for ($i = 1; $i < 10; $i++) {
            $F = "F" . $i;
            $newReading = $request->input('F' . $i);
            /* Insert readings */
            $waterReading = new WaterReadings;
            $waterReading->apartment = $F;
            $waterReading->reading = $newReading;
            //$waterReading->save();

            /* Get water reading for individual */
            $lastMonth = Carbon::now()->subMonth()->format("Y-m");
            $lastReading = WaterReadings::where('apartment', $F)->where('created_at', 'like', '%' . $lastMonth . '%')->first();
            $user = User::where('apartment', $F)->first();
            $betterDate = Carbon::now()->format("d M Y");
            $betterPhone = substr_replace($user->phone, '+254', 0, -9);
            $consumption = $newReading - $lastReading->reading;
            $bill = $consumption * 100;
            $message = "Dear Flat $i, your bill as at $betterDate:\n
                Prev Read: $lastReading->reading\n
                Curr Read: $newReading\n
                Consumption: $consumption\n
                Current Bill: KES $bill\n
                Pay via Mpesa to Alphaxard Njoroge 0700364446. Thank you.";
            //send($betterPhone, $message);
            //echo "$F, $betterPhone, $message <br>";
        }

        return redirect('water-readings/create')->with(['success' => 'Saved', 'betterPhone' => $betterPhone, 'message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WaterReadings  $waterReadings
     * @return \Illuminate\Http\Response
     */
    public function show($monthNum)
    {
        $users = User::skip(1)->take(9)->get();
        $waterReadings = WaterReadings::get();
        $month = Carbon::now()->subMonth($monthNum + 1)->format("F");
        /* Months to query */
        $lastMonth = Carbon::now()->subMonth($monthNum)->format("Y-m");
        $lastMonth2 = Carbon::now()->subMonth($monthNum + 1)->format("Y-m");
        $lastMonth3 = Carbon::now()->subMonth($monthNum + 2)->format("Y-m");
        /* Get total units used */
        $lastReadingTot = WaterReadings::where('created_at', 'like', '%' . $lastMonth . '%')->sum('reading');
        $lastReadingTot2 = WaterReadings::where('created_at', 'like', '%' . $lastMonth2 . '%')->sum('reading');
        $lastReadingTot3 = WaterReadings::where('created_at', 'like', '%' . $lastMonth3 . '%')->sum('reading');
        $totalUnits = $lastReadingTot - $lastReadingTot2;
        $proportion = $lastReadingTot2 - $lastReadingTot3;
        /* Get total units used */
        $totalPayments = WaterPayments::where('created_at', 'like', '%' . $lastMonth . '%')->sum('amount');

        /* Format proportion to show relative usage nicely */
        if ($proportion < 0) {
            $proportion = abs($proportion);
            $moreOrLess = "Less than last Month";
            $class = "success";
        } else {
            $moreOrLess = "More than last Month";
            $class = "danger";
        }

        return view('pages/index')->with([
            'users' => $users,
            'waterReadings' => $waterReadings,
            'month' => $month,
            'monthNum' => $monthNum,
            'lastMonth' => $lastMonth,
            'lastMonth2' => $lastMonth2,
            'lastMonth3' => $lastMonth3,
            'lastReadingTot' => $lastReadingTot,
            'lastReadingTot2' => $lastReadingTot2,
            'lastReadingTot3' => $lastReadingTot3,
            'totalUnits' => $totalUnits,
            'proportion' => $proportion,
            'moreOrLess' => $moreOrLess,
            'class' => $class,
            'totalPayments' => $totalPayments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WaterReadings  $waterReadings
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterReadings $waterReadings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WaterReadings  $waterReadings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaterReadings $waterReadings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WaterReadings  $waterReadings
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterReadings $waterReadings)
    {
        //
    }
}
