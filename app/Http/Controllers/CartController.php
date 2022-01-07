<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
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

        $cart = Cart::where('user_id',Auth::user()->id)
                      ->where('cart_status',1)
                      ->with('product')
                      ->get();
        $this->cart_count = 0;

        if (Auth::check()) 
        {
            $this->cart_count = (int)Cart::where('user_id',Auth::user()->id)->count();
        }

        return view('frontend.cart')->with('cart',$cart)->with('cart_count',$this->cart_count);

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
            'product_id'=>'required',
            'product_quantity'=>'required',
        ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
           return response()->json('error');
        } 
        else 
        {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->input('product_id');
            $cart->product_quantity = $request->input('product_quantity');
            $cart->total_cost = $request->input('cost')*$request->input('product_quantity');
            $cart->cart_status = 1;

            try 
            {
                $cart->save();

                return redirect()->route('/');

            } 
            catch (Exception $e) 
            {
                return response()->json(['message'=>'Error in saving cart']);
            }
        }

    }


    public function cartUpdate(Request $request)
    {
        // code...
        

        for ($i=0; $i < sizeof($request->input('id')) ; $i++) 
        { 
            // echo ;

            Cart::where('id',$request->input('id')[$i])
                    ->update([
                    'product_quantity'=>$request->input('product_quantity')[$i],
                    'total_cost'=>$request->input('product_quantity')[$i]*$request->input('cost')[$i],
                ]);

        }
        return redirect()->route('cart.index');
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

    public function deleteItem($id)
    {
        //
        $cart = Cart::findOrFail($id);

        try 
        {
            $cart->delete();
            return redirect()->route('cart.index');    
        } 
        catch (Exception $e) 
        {
            return response()->json(['message'=>'error']);    
        }
    }

    public function destroy($id)
    {
        //
        $cart = Cart::findOrFail($id);

        try 
        {
            $cart->delete();
            return redirect()->route('cart.index');    
        } 
        catch (Exception $e) 
        {
            return response()->json(['message'=>'error']);    
        }
    }
}
