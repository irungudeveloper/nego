<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discount = Discount::with('product')->get();
        return view('discount.index')->with('discount',$discount);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::where('availability_status',1)->get();

        return view('discount.create')->with('product',$products);
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
                    'percentage'=>'required',
                ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
            return response()->json($validator);
        }
        else
        {

            $random = Str::random(8);

            while (count(Discount::where('code',$random)->get()) > 0) 
            {
                $random = Str::random(8);
            }
            
            $discount = new Discount;
            $discount->code = $random;
            $discount->active = 1;
            $discount->product_id = $request->input('product_id');
            $discount->percentage = $request->input('percentage');
            $discount->user_id = Auth::user()->id;

            try 
            {
                $discount->save();
                return redirect()->route('discount.index')->with('success','Discount Code Created');
            } 
            catch (Exception $e) 
            {
                return response()->route('discount.index')->with('error','Not able to create discount code');
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
        $discount = Discount::where('id',$id)->with('product')->get();
        $products = Product::all();

        return view('discount.edit')
                ->with('discount',$discount)
                ->with('product',$products);
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
                    'product_id'=>'required',
                    'percentage'=>'required',
                ];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
            return redirect()->route('discount.index')->withErrors($validator);
        }
        else
        {
            try 
            {
                Discount::where('id',$id)
                        ->update([
                                    'percentage'=>$request->input('percentage'),
                                    'product_id'=>$request->input('product_id'),
                                    'active'=>$request->input('active'),
                                ]);   

                return redirect()->route('discount.index')->with('success','Discount Updated');
            } 
            catch (Exception $e) 
            {
                return redirect()->route('discount.index')->with('error','Error in updating discount');
            }
            
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
        $discount = Discount::findOrFail($id);

        try 
        {
            $discount->delete();
            return redirect()->route('discount.index')->with('success','Discount deleted');
        } 
        catch (Exception $e) 
        {
            return redirect()->route('discount.index')->with('error','Error in deleting discount');
        }
    }
}
