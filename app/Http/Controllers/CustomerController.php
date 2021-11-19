<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::where('user_id',Auth::user()->id)->with('user')->get();

        return view('admin.customer')->with('customer',$customer);

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
                  ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('Invalid Input');
        }
        else 
        {
            $check = Customer::where('user_id',Auth::user()->id)->get();

            if (count($check) <= 0) 
            {
                $customer = new Customer;
                $customer->user_id = Auth::user()->id;
                $customer->first_name = $request->input('first_name');
                $customer->last_name = $request->input('last_name');
                $customer->phone_number = $request->input('phone_number');
                $customer->email = $request->input('email');

                try 
                {
                    $customer->save();
                    User::where('id',Auth::user()->id)->update([
                            'first_name'=>$request->input('first_name'),
                            'last_name'=>$request->input('last_name'),
                            'email'=>$request->input('email'),
                        ]);  
                    return redirect()->route('customer');
                } 
                catch (Exception $e) 
                {
                    return response()->json('Customer error');
                }
            } 
            else 
            {
                Customer::where('user_id',Auth::user()->id)->update([
                            'first_name'=>$request->input('first_name'),
                            'last_name'=>$request->input('last_name'),
                            'email'=>$request->input('email'),
                            'phone_number'=>$request->input('phone_number'),
                    ]);   
                User::where('id',Auth::user()->id)->update([
                            'first_name'=>$request->input('first_name'),
                            'last_name'=>$request->input('last_name'),
                            'email'=>$request->input('email'),
                    ]);   
                return redirect()->route('customer');
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
