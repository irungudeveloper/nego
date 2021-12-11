<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $average_purchase_price = (int)Product::where('user_id',Auth::user()->id)
                                            ->avg('product_price');

        $average_income = Order::all()->avg('amount');

        $customer_count = User::where('role_id',2)->count(); 

        return view('home')->with('average_purchase_price',$average_purchase_price)
                            ->with('average_income',$average_income)
                            ->with('customer_count',$customer_count);

    }

    public function customer()
    {
        // code...

        return response()->json(['Message'=>'Client Dashboard']);
    }
}
