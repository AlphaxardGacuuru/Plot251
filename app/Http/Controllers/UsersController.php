<?php

namespace App\Http\Controllers;

use App\User;
use App\WaterReadings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
        $lastReadingTot = WaterReadings::where('created_at', 'like', '%' . $lastMonth . '%')
            ->where('apartment', auth()->user()->apartment)->sum('reading');
        $lastReadingTot2 = WaterReadings::where('created_at', 'like', '%' . $lastMonth2 . '%')
            ->where('apartment', auth()->user()->apartment)->sum('reading');
        $lastReadingTot3 = WaterReadings::where('created_at', 'like', '%' . $lastMonth3 . '%')
            ->where('apartment', auth()->user()->apartment)->sum('reading');
        $totalUnits = $lastReadingTot - $lastReadingTot2;
        $proportion = $lastReadingTot2 - $lastReadingTot3;

        /* Format proportion to show relative usage nicely */
        if ($proportion < 0) {
            $proportion = abs($proportion);
            $moreOrLess = "Less than last Month";
            $class = "success";
        } else {
            $moreOrLess = "More than last Month";
            $class = "danger";
        }

        return view('pages/user')->with([
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
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
