<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\helper\mpesa_utils;

use App\Models\Billing;
use App\Models\Customer;
use App\Models\Delivery;
// use App\Models\User;
use App\Models\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $cart_count;

    public function index()
    {
        //
        $delivery = Delivery::all();
        $billing = Billing::where('user_id',Auth::user()->id)->with('delivery')->get();
        $customer = Customer::where('user_id',Auth::user()->id)->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();

         $this->cart_count = 0;

        if (Auth::check()) 
        {
            $this->cart_count = (int)Cart::where('user_id',Auth::user()->id)->count();
        }

        return view('frontend.checkout')->with('delivery',$delivery)
                                        ->with('billing',$billing)
                                        ->with('cart',$cart)
                                        ->with('customer',$customer)
                                        ->with('cart_count',$this->cart_count);
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
