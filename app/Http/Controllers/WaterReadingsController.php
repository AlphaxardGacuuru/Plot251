<?php

namespace App\Http\Controllers;

// AfricasTalking
use AfricasTalking\SDK\AfricasTalking;
use App\SMS;
use App\User;
use App\WaterPayments;
use App\WaterReadings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaterReadingsController extends Controller
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

        Http::withHeaders([
            // 'apiKey' => env('AFRICASTKNG_API_KEY_SANDBOX'),
            'apiKey' => env('AFRICASTKNG_API_KEY'),
            // ])->post('https://api.sandbox.africastalking.com/auth-token/generate', [
        ])->post('https://api.africastalking.com/auth-token/generate', [
            // 'username' => env('AFRICASTKNG_USERNAME_SANDBOX'),
            'username' => env('AFRICASTKNG_USERNAME'),
        ]);

        for ($i = 1; $i < 10; $i++) {
            $F = "F" . $i;
            $newReading = $request->input('F' . $i);
            /* Insert readings */
            $waterReading = new WaterReadings;
            $waterReading->apartment = $F;
            $waterReading->reading = $newReading;
            $waterReading->save();

            /* Get water reading for individual */
            $lastMonth = Carbon::now()->subMonth()->format("Y-m");
            $lastReading = WaterReadings::where('apartment', $F)
                ->where('created_at', 'like', '%' . $lastMonth . '%')
                ->first();
            $user = User::where('apartment', $F)->first();
            $betterDate = Carbon::now()->format("d M Y");
            $betterPhone = substr_replace($user->phone, '+254', 0, -9);
            $consumption = $newReading - $lastReading->reading;
            $bill = $consumption * 100;
            $message = "Dear Flat $i,\nYour bill as at $betterDate:\nPrev Read: $lastReading->reading\nCurr Read: $newReading\nConsumption: $consumption\nCurrent Bill: KES $bill\nPay via Mpesa to Alphaxard Njoroge 0700364446. Thank you.";

            // Set your app credentials
            // $username = "sandbox";
            $username = "plot251";
            // $apiKey = "be25ed4a43e7a6bddc176e0b38772afb52790ca0c29287b539cf390d3e08a73b";
            $apiKey = "8c34325475a7d7d5644b04fb2aa1b1a0ddf123458b9980f36f594af699abd06f";

            // Initialize the SDK
            $AT = new AfricasTalking($username, $apiKey);

            // Get the SMS service
            $sms = $AT->sms();

            // Set the numbers you want to send to in international format
            // $recipients = "+254700364446";
            $recipients = $betterPhone;

            // Set your message
            // $message = "I'm a lumberjack and its ok, I sleep all night and I work all day";

            // Set your shortCode or senderId
            $from = "";

            if (strlen($betterPhone) > 5) {
                try {
                    // Thats it, hit send and we'll take care of the rest
                    $result = $sms->send([
                        'to' => $recipients,
                        'message' => $message,
                        'from' => $from,
                        'enqueue' => 1,
                    ]);

                    foreach ($result as $key => $value) {
                        if (gettype($value) != "string") {
                            foreach ($value as $key1 => $value1) {
                                if (gettype($value1) != "string") {
                                    foreach ($value1 as $key2 => $value2) {
                                        if (gettype($value2) == "array") {
                                            foreach ($value2 as $key3 => $value3) {
                                                echo "<h3>" . $value3->statusCode . "</h3>";
                                                echo "<h3>" . $value3->number . "</h3>";
                                                echo "<h3>" . $value3->status . "</h3>";
                                                echo "<h3>" . $value3->cost . "</h3>";
                                                echo "<h3>" . $value3->messageId . "</h3>";

                                                // Save to database
                                                $sms = new SMS;
                                                $sms->message_id = $value3->messageId;
                                                $sms->number = $value3->number;
                                                $sms->text = $message;
                                                $sms->status = $value3->status;
                                                $sms->status_code = $value3->statusCode;
                                                $sms->cost = $value3->cost;
                                                $sms->save();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }

        return redirect('water-readings/create')->with(['success' => 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WaterReadings  $waterReadings
     * @return \Illuminate\Http\Response
     */
    public function show($monthNum)
    {
        /* Months to query */
        $month = Carbon::now()->subMonth($monthNum + 1)->format("F");
        $lastMonth = Carbon::now()->subMonth($monthNum)->format("Y-m");
        $lastMonth2 = Carbon::now()->subMonth($monthNum + 1)->format("Y-m");
        $lastMonth3 = Carbon::now()->subMonth($monthNum + 2)->format("Y-m");

        $users = User::skip(1)->take(9)->get();

        $apartments = [];

        if ($monthNum >= 0) {

            // Generate apartments list
            foreach ($users as $key => $user) {
                /* Get units used per apartment */
                $lastReading = WaterReadings::where('apartment', $user->apartment)
                    ->where('created_at', 'like', '%' . $lastMonth . '%')
                    ->first();
                $lastReading2 = WaterReadings::where('apartment', $user->apartment)
                    ->where('created_at', 'like', '%' . $lastMonth2 . '%')
                    ->first();

                // Check if records for last month are available then return page
                if (!$lastReading) {

                    return view('pages/index')->with([
                        'apartments' => [],
                        'month' => $month,
                        'monthNum' => $monthNum,
                        'lastReadingTot' => '',
                        'lastReadingTot2' => '',
                        'lastReadingTot3' => '',
                        'totalUnits' => '',
                        'totalLitres' => '',
                        'totalBill' => '',
                        'totalPayments' => '',
                        'proportion' => '',
                        'moreOrLess' => '',
                        'class' => '',
                    ]);
                }

                $units = $lastReading->reading - $lastReading2->reading;

                /* Get water payments per apartment */
                $waterPayment = WaterPayments::where('apartment', $user->apartment)
                    ->where('created_at', 'like', '%' . $lastMonth . '%')
                    ->first();

                // Get correct data depending on whether the user has paid or not
                // Show data of current tenant
                if ($monthNum == 0) {
                    $name = $user->name;
                    $phone = $user->phone;
                    $amount = $waterPayment ? $waterPayment->amount : "";
                } else {
                    // Show info of the person who paid
                    $name = $waterPayment ? $waterPayment->name : "";
                    $phone = $waterPayment ? $waterPayment->phone : "";
                    $amount = $waterPayment ? $waterPayment->amount : "";
                }

                // Populate array
                array_push($apartments, [
                    'name' => $name,
                    'phone' => $phone,
                    'apartment' => $user->apartment,
                    'userPhone' => $user->phone,
                    'units' => $units,
                    'litres' => $units * 1000,
                    'bill' => $units * 100,
                    'paid' => $amount,
                    'balance' =>$units * 100 - (int)$amount,
                ]);
            }

            /* Get total units used */
            $lastReadingTot = WaterReadings::where('created_at', 'like', '%' . $lastMonth . '%')->sum('reading');
            $lastReadingTot2 = WaterReadings::where('created_at', 'like', '%' . $lastMonth2 . '%')->sum('reading');
            $lastReadingTot3 = WaterReadings::where('created_at', 'like', '%' . $lastMonth3 . '%')->sum('reading');
            $totalUnits = $lastReadingTot - $lastReadingTot2;
            $proportion = $totalUnits - ($lastReadingTot2 - $lastReadingTot3);
            $proportion = ($proportion * 100) / ($lastReadingTot2 - $lastReadingTot3);
            $proportion = round($proportion);
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
                'apartments' => $apartments,
                'month' => $month,
                'monthNum' => $monthNum,
                'lastReadingTot' => $lastReadingTot,
                'lastReadingTot2' => $lastReadingTot2,
                'lastReadingTot3' => $lastReadingTot3,
                'totalUnits' => $totalUnits,
                'totalLitres' => $totalUnits * 1000,
                'totalBill' => $totalUnits * 100,
                'totalPayments' => $totalPayments,
                'proportion' => $proportion,
                'moreOrLess' => $moreOrLess,
                'class' => $class,
            ]);
        }

        return view('pages/index')->with([
            'apartments' => [],
            'month' => $month,
            'monthNum' => $monthNum,
            'lastReadingTot' => '',
            'lastReadingTot2' => '',
            'lastReadingTot3' => '',
            'totalUnits' => '',
            'totalLitres' => '',
            'totalBill' => '',
            'totalPayments' => '',
            'proportion' => '',
            'moreOrLess' => '',
            'class' => '',
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
