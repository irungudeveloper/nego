<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\helper\mpesa_utils;

use App\Models\Mpesa;

class MpesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json('reached');
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

        $rules = ['phone_number'=>'required','amount'=>'required'];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('invalid input');
        }
        else
        {
            $stk_push = new mpesa_utils;

            $response = $stk_push->onlineCheckout($request->input('phone_number'),$request->input('amount'));

            // return response()->json($response);

            $mpesa = new Mpesa;

            $mpesa->user_id = Auth::user()->id;
            $mpesa->merchant_request_id = $response['MerchantRequestID'];
            $mpesa->checkout_request_id = $response['CheckoutRequestID'];
            $mpesa->amount = $request->input('amount');
            $mpesa->transaction_status = 0;

            try 
            {
                $mpesa->save();

                return response()->json($response['CheckoutRequestID']);   
            } 
            catch (Exception $e) 
            {
                return response()->json('error in saving record');
            }

        }

    }

    public function transactionConfirmation(Request $request)
    {
        // code...
        $transaction = new mpesa_utils;
        $result = $transaction->transactionStatus($request->input('checkoutID'));

        try 
        {
            Mpesa::where('checkout_request_id',$request->input('checkoutID'))
                ->update(['transaction_status'=>$result]);
        } 
        catch (Exception $e) 
        {
            return response()->json('error in updating record');
        }

        return response()->json($result);

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
