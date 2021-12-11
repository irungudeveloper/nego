<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Tasks;
use App\Models\Cart;

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

        $tasks = Tasks::where('user_id',Auth::user()->id)->get();

        return view('home')->with('average_purchase_price',$average_purchase_price)
                            ->with('average_income',$average_income)
                            ->with('customer_count',$customer_count)
                            ->with('tasks',$tasks);

    }

    public function customer()
    {
        // code...

        $cart_items = Cart::where('user_id',Auth::user()->id)->count();
        $orders = Order::where('user_id',Auth::user()->id)->count();
        $spent = (int)Order::where('user_id',Auth::user()->id)
                        ->avg('amount');

        return view('clientdashboard')->with('cart_item',$cart_items)
                                        ->with('order_items',$orders)
                                        ->with('order_amount',$spent);
    }
}
