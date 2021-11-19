<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Billing;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\User;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $billing = Billing::where('user_id',Auth::user()->id)->get();
        $customer = Customer::where('user_id',Auth::user()->id)->get();
        $delivery = Delivery::all();

        return view('admin.billing')->with('billing',$billing)->with('customer',$customer)->with('delivery',$delivery);
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

        $rules = [
                    'first_name'=>'required',
                    'last_name'=>'required',
                    'phone_number'=>'required',
                    'email'=>'required',
                    'delivery_id'=>'required',
                    'address'=>'required',
                    'payment_mode'=>'required',
                 ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('Invalid Input');
        }
        else
        {
            $customer_check = Customer::where('user_id',Auth::user()->id)->get();
            $billing_check = Billing::where('user_id',Auth::user()->id)->get(); 

            if (count($customer_check) <= 0) 
            {
                $customer = new Customer;
                $customer->first_name = $request->input('first_name');
                $customer->last_name = $request->input('last_name');
                $customer->email = $request->input('email');
                $customer->phone_number = $request->input('phone_number');

                try 
                {
                    $customer->save();   
                    User::where('id',Auth::user()->id)
                        ->update([
                                    'first_name'=>$request->input('first_name'),
                                    'last_name'=>$request->input('last_name'),
                                    'email'=>$request->input('email'),
                                ]);
                } 
                catch (Exception $e) 
                {
                    return response()->json('Customer Data Error');
                }
            } 
             else 
            {
                try 
                {
                    
                    User::where('id',Auth::user()->id)
                        ->update([
                                    'first_name'=>$request->input('first_name'),
                                    'last_name'=>$request->input('last_name'),
                                    'email'=>$request->input('email'),
                                ]);

                    Customer::where('user_id',Auth::user()->id)
                                ->update([
                                            'first_name'=>$request->input('first_name'),
                                            'last_name'=>$request->input('last_name'),
                                            'email'=>$request->input('email'),
                                            'phone_number'=>$request->input('phone_number'),
                                        ]);

                } 
                catch (Exception $e) 
                {
                    return response()->json('Customer Data Error');
                }
            }

            if (count($billing_check) <= 0) 
            {
                // code...
                $billing = new Billing;
                $billing->delivery_id = $request->input('delivery_id');
                $billing->address = $request->input('address');
                $billing->payment_mode = $request->input('payment_mode');
                $billing->user_id = Auth::user()->id;

                $billing->save();

                return redirect()->back();
            } 
            else 
            {
                try 
                {
                    Billing::where('user_id',Auth::user()->id)
                                ->update([
                                            'user_id'=>Auth::user()->id,
                                            'delivery_id'=>$request->input('delivery_id'),
                                            'address'=>$request->input('address'),
                                            'payment_mode'=>$request->input('payment_mode'),
                                        ]);

                    return redirect()->back();

                } 
                catch (Exception $e) 
                {
                    return response()->json('Billing Info Error');
                }
            }
            
              
        }
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
