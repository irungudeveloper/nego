<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brand = Brand::all();

        $count = $brand->count();

        return view('brand.index')->with('brand',$brand)
                                    ->with('count',$count);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brand.create');
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
        $rules = ['brand_name'=>'required'];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
        }
        else
        {
            $brand = new Brand;
            $brand->brand_name = $request->brand_name;

            try 
            {
                $brand->save();

                return redirect()->route('brand.create');
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
        $brand = Brand::findOrFail($id);
        return view('brand.show')->with('brand',$brand);
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
        $brand = Brand::findOrFail($id);
        return view('brand.edit')->with('brand',$brand);
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
        $rules = ['brand_name'=>'required'];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
        } 
        else
        {
            try 
            {
                 Brand::where('id', $id)
                          ->update(['brand_name' => $request->brand_name]);   
                return redirect()->route('brand.index');
            } 
            catch (Exception $e) 
            {
                
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
        $brand = Brand::findOrFail($id);

        try 
        {
            $brand->delete();
            return redirect()->route('brand.index');   
        } 
        catch (Exception $e) 
        {
            
        }
    }
}
