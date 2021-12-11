<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Delivery;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $delivery = Delivery::where('user_id',Auth::user()->id)->get();

        $count = $delivery->count();

        return view('delivery.index')->with('delivery',$delivery)
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
        return view('delivery.create');

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
                    'area_name'=>'required',
                    'delivery_cost'=>'required',
                 ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('Invalid Input');
        } 
        else 
        {
            $delivery = new Delivery;

            $delivery->user_id = Auth::user()->id;
            $delivery->area_name = $request->input('area_name');
            $delivery->delivery_cost = $request->input('delivery_cost');

            try 
            {
                $delivery->save();
                return redirect()->route('delivery.index');
            } 
            catch (Exception $e) 
            {
                return response()->json('Delivery Error');
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
        $delivery = Delivery::findOrFail($id);

        return view('delivery.edit')->with('delivery',$delivery);
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
                    'area_name'=>'required',
                    'delivery_cost'=>'required',
                 ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            return response()->json('Invalid Input');
        } 
        else 
        {
            try 
            {
                Delivery::where('id',$id)->update([
                    'user_id'=>Auth::user()->id,
                    'area_name'=>$request->input('area_name'),
                    'delivery_cost'=>$request->input('delivery_cost'),
                ]);

                return redirect()->route('delivery.index');
            } 
            catch (Exception $e) 
            {
                return response()->json('Delivery Update Error');
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
        $delivery = Delivery::findOrFail($id);

        try 
        {
            $delivery->delete();
            return redirect()->route('delivery.index');
        } 
        catch (Exception $e) 
        {
            return response()->json('Delivery Delete Error');
        }
    }
}
