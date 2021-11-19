<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Merchant;
use App\Models\User;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $merchant = Merchant::where('user_id',Auth::user()->id)
                              ->with('user')
                              ->get();

        return view('admin.merchant')->with('merchant',$merchant);

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
                    'share_contact'=>'required',
                  ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('Invalid Input');
        }
        else
        {
            $check = Merchant::where('user_id',Auth::user()->id)->get();

           
                // return response()->json(count($check));
            
            if (count($check) <= 0) 
            {
                $merchant = new Merchant;
                $merchant->user_id = Auth::user()->id;
                $merchant->first_name = $request->input('first_name');
                $merchant->last_name = $request->input('last_name');
                $merchant->phone_number = $request->input('phone_number');
                $merchant->email = $request->input('email');
                $merchant->share_contact = $request->input('share_contact');

                try 
                {
                    $merchant->save();

                    User::where('id',Auth::user()->id)
                          ->update([
                                        'first_name'=>$request->input('first_name'),
                                        'last_name'=>$request->input('last_name'),
                                        'email'=>$request->input('email'),
                                   ]);

                    return redirect()->route('merchant');
                } 
                catch (Exception $e) 
                {
                    return response()->json('Merchant error');
                }
            }
            else
            {
                Merchant::where('user_id',Auth::user()->id)
                          ->update([
                                    'first_name'=>$request->input('first_name'),
                                    'last_name'=>$request->input('last_name'),
                                    'phone_number'=>$request->input('phone_number'),
                                    'email'=>$request->input('email'),
                                    'share_contact'=>$request->input('share_contact'),
                                   ]);

                User::where('id',Auth::user()->id)
                          ->update([
                                        'first_name'=>$request->input('first_name'),
                                        'last_name'=>$request->input('last_name'),
                                        'email'=>$request->input('email'),
                                   ]);

                return redirect()->route('merchant');
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
