<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $order = Order::with('product')->with('user.billing.delivery')->get();

        $pending_orders = Order::where('delivery_status',0)->count();
        $cancelled_orders = Order::where('delivery_status',3)->count();
        $completed_orders = Order::where('delivery_status',1)->count();
        $total_orders = Order::all()->count();

        return view('order.index')->with('order',$order)
                                    ->with('pending',$pending_orders)
                                    ->with('cancelled',$cancelled_orders)
                                    ->with('completed',$completed_orders)
                                    ->with('total',$total_orders);

    }

    public function customer()
    {
        // echo "reached";
        // return response()->json('here');
        $order = Order::where('user_id',Auth::user()->id)->with('product')->with('user.billing.delivery')->get();

        $pending_orders = Order::where('user_id',Auth::user()->id)
                                ->where('delivery_status',0)
                                ->count();
        $cancelled_orders = Order::where('user_id',Auth::user()->id)
                                ->where('delivery_status',3)
                                ->count();

        $completed_orders = Order::where('user_id',Auth::user()->id)
                                ->where('delivery_status',1)
                                ->count();
        $total_orders = Order::where('user_id',Auth::user()->id)->count();

        return view('order.customer')->with('order',$order)
                                        ->with('pending',$pending_orders)
                                        ->with('cancelled',$cancelled_orders)
                                        ->with('total',$total_orders)
                                        ->with('completed',$completed_orders);
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
    public function store()
    {
        //

        $cart = Cart::where('user_id',Auth::user()->id)->get();

        foreach($cart as $data)
        {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->product_id = $data->product_id;
            $order->quantity = $data->product_quantity;
            $order->amount = $data->total_cost;
            $order->delivery_status = 0;
            try 
            {
                $order->save();    
            } 
            catch (Exception $e) 
            {
                return response()->json('error in creating order');    
            }
            try 
            {
                Product::where('id',$data->product_id)->decrement('product_quantity',$data->product_quantity);
            } 
            catch (Exception $e) 
            {
                return response()->json('error in updating product value');
            }
            try 
            {
                Cart::where('id',$data->id)->delete();    
            } 
            catch (Exception $e) 
            {
                return response()->json('error in emptying cart');
            }
        }

        return response()->json(true);

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

    public function confirmDelivery()
    {
        // code...


        
    }

    public function deliveryConfirm($id)
    {
        // code...
       try 
        {
            Order::where('id',$id)
                    ->update(['delivery_status'=>1]);

            return redirect()->route('order.index')->with('success','Order Status Updated');    
        } 
        catch (Exception $e) 
        {
            return redirect()->route('order.index')->with('error','Order Status Not Updated');
        }
    }

    public function cancelOrder($id)
    {
        // code...
        try 
        {
            Order::where('id',$id)
                    ->where('delivery_status',0)
                    ->update(['delivery_status'=>3]);

            return redirect()->route('customer.order')->with('success','Order Status Updated');    
        } 
        catch (Exception $e) 
        {
            return redirect()->route('customer.order')->with('error','Order Status Not Updated');
        }

    }

}
