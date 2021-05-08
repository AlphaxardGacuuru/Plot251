<?php

namespace App\Http\Controllers;

use App\WaterPayments;
use Illuminate\Http\Request;

class WaterPaymentsController extends Controller
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
        return view('pages/water-payments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/water-payments-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $waterPayment = new WaterPayments;
        $waterPayment->apartment = $request->input('apartment');
        $waterPayment->amount = $request->input('amount');
        $waterPayment->save();

        return redirect('water-payments/create')->with('success', 'Payment saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WaterPayments  $waterPayments
     * @return \Illuminate\Http\Response
     */
    public function show(WaterPayments $waterPayments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WaterPayments  $waterPayments
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterPayments $waterPayments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WaterPayments  $waterPayments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaterPayments $waterPayments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WaterPayments  $waterPayments
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterPayments $waterPayments)
    {
        //
    }
}
