<?php

namespace App\Http\Controllers;

// AfricasTalking
use AfricasTalking\SDK\AfricasTalking;
use App\SMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
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
        // return view('/pages/sms-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$sms = new SMS;
		$sms->message_id = $request->id;
		$sms->status = $request->status;
		$sms->number = $request->phoneNumber;
		$sms->network_code = $request->networkCode;
		$sms->failure_reason = $request->failureReason;
		$sms->retry_count = $request->retryCount;
		$sms->save();

        // Http::withHeaders([
        //     'apiKey' => 'be25ed4a43e7a6bddc176e0b38772afb52790ca0c29287b539cf390d3e08a73b',
        //     // 'apiKey' => '8c34325475a7d7d5644b04fb2aa1b1a0ddf123458b9980f36f594af699abd06f',
        // ])->post('https://api.sandbox.africastalking.com/auth-token/generate', [
        //     // ])->post('https://api.africastalking.com/auth-token/generate', [
        //     'username' => 'sandbox',
        //     // 'username' => 'plot251',
        // ]);

        // $F = $request->input('apartment');
        // $bill = $request->input('bill');
        // $phone = $request->input('phone');
        // $betterPhone = substr_replace($phone, '+254', 0, -9);
        // $message = "Dear $F,\n your Current Bill: KES $bill is still due.\n Pay via Mpesa to Alphaxard Njoroge 0700364446.\n Thank you.";

        // echo "$F, $betterPhone, $message <br>";

        // // Set your app credentials
        // $username = "sandbox";
        // // $username = "plot251";
        // $apiKey = "be25ed4a43e7a6bddc176e0b38772afb52790ca0c29287b539cf390d3e08a73b";
        // // $apiKey = "8c34325475a7d7d5644b04fb2aa1b1a0ddf123458b9980f36f594af699abd06f";

        // // Initialize the SDK
        // $AT = new AfricasTalking($username, $apiKey);

        // // Get the SMS service
        // $sms = $AT->sms();

        // // Set the numbers you want to send to in international format
        // // $recipients = "+254700364446";
        // $recipients = $betterPhone;

        // // Set your message
        // // $message = "I'm a lumberjack and its ok, I sleep all night and I work all day";

        // // Set your shortCode or senderId
        // $from = "";

        // if (strlen($betterPhone) > 5) {
        //     try {
        //         // Thats it, hit send and we'll take care of the rest
        //         $result = $sms->send([
        //             'to' => $recipients,
        //             'message' => $message,
        //             'from' => $from
        //         ]);

        //         foreach ($result as $key => $value) {
        //             if (gettype($value) != "string") {
        //                 foreach ($value as $key1 => $value1) {
        //                     if (gettype($value1) != "string") {
        //                         foreach ($value1 as $key2 => $value2) {
        //                             if (gettype($value2) == "array") {
        //                                 foreach ($value2 as $key3 => $value3) {
        //                                     // Save to database
        //                                     $sms = new SMS;
        //                                     $sms->message_id = $value3->messageId;
        //                                     $sms->number = $value3->number;
        //                                     $sms->status = $value3->status;
        //                                     $sms->status_code = $value3->statusCode;
        //                                     $sms->cost = $value3->cost;
        //                                     $sms->save();
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     } catch (Exception $e) {
        //         echo "Error: " . $e->getMessage();
        //     }
        // }

        // return redirect('water-readings')->with(['success' => 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function show(SMS $sMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sMS)
    {
        //
    }
}
