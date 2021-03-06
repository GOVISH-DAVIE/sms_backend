<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Clients;
use App\Models\SMSClient;
use App\Models\SMSGroup;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use DateTime;

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
        $username = 'payspap'; // use 'sandbox' for development in the test environment
        $apiKey   = '16544c7fe647e8e098efdead113123abc81fb77b028c1edc6edc95d48361aafd'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();

        // Use the service

        $client = Clients::find($request->client);
        // print_r($result);
        $result   = $sms->send([
            'to'      => "$client->tel",
            'message' => $request->sms
        ]);
        SMSClient::create([
            'client_id' => $request->client,
            'sms' => $request->sms
        ]);
        return $result;
        // $sms = 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sms = SMSClient::where('client_id', $id)->get();
        return $sms;
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
    public function smsgroup(Request $request)
    {
        # code...
        $username = 'payspap'; // use 'sandbox' for development in the test environment
        $apiKey   = '16544c7fe647e8e098efdead113123abc81fb77b028c1edc6edc95d48361aafd'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();

        // Use the service

        // return $request->client_id;
        // $client = Clients::find($request->client);
        // print_r($result);
        $result   = $sms->send([
            'to'      => json_decode($request->client_id),
            'message' => $request->sms
        ]);


        $startTime = new DateTime("$request->date $request->time");
        // return $startTime->format('Y-m-d H:i:s');
        //  $t = new Date($request->date)

        $s = new SMSGroup();
        $s->group_id = $request->client;
        $s->sms = $request->sms;
        $s->timeframe = $startTime;
        $s->sent = 'false';
        $s->numbers = $request->client_id;
        $s->save();
        return $result;
    }
}
