<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::where('user_id',Auth::user()->id)->get();

        $total_products = Product::where('user_id',Auth::user()->id)->count();
        $negotiable_products = Product::where('user_id',Auth::user()->id)
                                            ->where('negotiable',1)
                                            ->count();
        $available_products = Product::where('user_id',Auth::user()->id)
                                        ->where('availability_status',1)
                                        ->count();

        return view('product.index')->with('product',$product)
                                    ->with('total_products',$total_products)
                                    ->with('negotiable_products',$negotiable_products)
                                    ->with('available_products',$available_products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $brand = Brand::all();

        return view('product.create')->with('category',$category)
                                    ->with('brand',$brand);

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
                    'product_name'=>'required',
                    'product_image'=>'required',
                    'category_id'=>'required',
                    'brand_id'=>'required',
                    'product_quantity'=>'required',
                    'product_retail_price'=>'required',
                    'product_final_price'=>'required',
                    'negotiable'=>'required',
                    'availability_status'=>'required',
                    'product_price'=>'required',
        ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
        } 
        else 
        {
            try 
            {
                $product = new Product;

                $product->product_name = $request->input('product_name');
                $product->category_id = $request->input('category_id');
                $product->brand_id = $request->input('brand_id');
                $product->product_quantity = $request->input('product_quantity');
                $product->product_retail_price = $request->input('product_retail_price');
                $product->product_final_price = $request->input('product_final_price');
                $product->negotiable = $request->input('negotiable');
                $product->availability_status = $request->input('availability_status');
                $product->product_image = $request->file('product_image')->getClientOriginalName();
                $product->user_id = Auth::user()->id;
                $product->product_price = $request->input('product_price');

                $product->save();

                if(!Storage::exists('/public/images')) 
                {

                    Storage::makeDirectory('/public/images', 0777, true); //creates directory

                    $path = '/public/images/';
                    $image_path = $request->file('product_image')->storeAs($path,$request->file('product_image')->getClientOriginalName());

                    $url = Storage::url($request->file('product_image')->getClientOriginalName());

                }
                else
                {
                    $path = '/public/images/';

                    $image_path = $request->file('product_image')->storeAs($path,$request->file('product_image')->getClientOriginalName());
                    $url = Storage::url($request->file('product_image')->getClientOriginalName());
                }

                return redirect()->route('product.create');


            } 
            catch (Exception $e) 
            {
                
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

        $product = Product::findOrFail($id);

        return view('product.show')->with('product',$product);
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
         $product = Product::findOrFail($id);
         $brand = Brand::all();
         $category = Category::all();

        return view('product.edit')->with('product',$product)
                                    ->with('brand',$brand)
                                    ->with('category',$category);
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
         $rules = [
                    'product_name'=>'required',
                    'product_image'=>'required',
                    'category_id'=>'required',
                    'brand_id'=>'required',
                    'product_quantity'=>'required',
                    'product_retail_price'=>'required',
                    'product_final_price'=>'required',
                    'negotiable'=>'required',
                    'availability_status'=>'required',
                    'product_price'=>'required',
        ];

        

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
        } 
        else 
        {
            Product::where('id',$id)->update([
                    'product_name'=>$request->input('product_name'),
                    'product_image'=>$request->file('product_image')->getClientOriginalName(),
                    'user_id'=>Auth::user()->id,
                    'category_id'=>$request->input('category_id'),
                    'brand_id'=>$request->input('brand_id'),
                    'negotiable'=>$request->input('negotiable'),
                    'product_quantity'=>$request->input('product_quantity'),
                    'product_final_price'=>$request->input('product_final_price'),
                    'product_retail_price'=>$request->input('product_retail_price'),
                    'availability_status'=>$request->input('availability_status'),   
                    'product_price'=>$request->input('product_price'),     
                ]);  

        $path = '/public/images/';

        $image_path = $request->file('product_image')->storeAs($path,$request->file('product_image')->getClientOriginalName());
        $url = Storage::url($request->file('product_image')->getClientOriginalName());

        return redirect()->route('product.index'); 
        }
        
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
        $product = Product::findOrFail($id);

        try 
        {
           $product->delete();
           return redirect()->route('product.index'); 
        }
         catch (Exception $e) 
        {
            
        }
    }
}
