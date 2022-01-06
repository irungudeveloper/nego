<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Cart;

use Session;

class StoreController extends Controller
{

    private $cart_count;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
        $category = Category::with('product')->get();
        $this->cart_count = 0;

        if (Auth::check()) 
        {
            $this->cart_count = (int)Cart::where('user_id',Auth::user()->id)->count();
        }

        return view('frontend.landing')->with('products',$products)
                                        ->with('category',$category)
                                        ->with('cart_count',$this->cart_count);

    }

    public function single($id)
    {
        // code...
        $product = Product::findOrFail($id);
        $this->cart_count = 0;

        if (Auth::check()) 
        {
            $this->cart_count = (int)Cart::where('user_id',Auth::user()->id)->count();
        }

        // $product_id

        // foreach($product as $data)
        // {
        //     $product_id = $data->id;
        // }

        // return response()->json($product->id);

        Session::put('product_id',$product->id);

        return view('frontend.single')->with('product',$product)
                                      ->with('cart_count',$this->cart_count);
    }

    public function categoryProducts($id)
    {
        $category = Category::where('id',$id)->with('product')
                                            ->get();
        $this->cart_count = 0;
        if (Auth::check()) 
        {
            $this->cart_count = (int)Cart::where('user_id',Auth::user()->id)->count();
        }

        return view('frontend.category')->with('category',$category)
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
