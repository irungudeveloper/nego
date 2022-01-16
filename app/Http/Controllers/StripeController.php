<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

use Session;
use Stripe;

class StripeController extends Controller
{
    //
    public function index()
    {
        // code...
        return view('frontend.stripe');
    }

    public function pay(Request $request)
    {
        // code...
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $response_data = Stripe\Charge::create(
            [
                "amount"=>$request->input('amount'),
                "currency"=>"usd",
                "source"=>$request->stripeToken,
                "description"=>"This is a test payment"
            ]);

        $create_order = (new OrderController)->store();
        
        return redirect()->back();

        // return response()->json(['order_creation'=>$create_order]);

        // return response()->json(['card_data'=>$response_data]);

        // // Session::flash('success','Payment Successful');

        // return back();
    }

}
