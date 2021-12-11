<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();

        $count = $category->count();

        return view('category.index')->with('category',$category)
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
        return view('category.create');
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
                    'category_name'=>'required'
        ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
           return response()->json('error');
        } 
        else 
        {
            $category = new Category;
            $category->category_name = $request->category_name;
            // $category->save();
            try 
            {
                $category->save();
                return view('category.create');    
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
        $category = Category::findOrFail($id);
        return view('category.show')->with('category',$category);
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
        $category = Category::findOrFail($id);
        return view('category.edit')->with('category',$category);
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
        $rules = ['category_name'=>'required'];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
        } 
        else 
        {
            Category::where('id', $id)
                    ->update(['category_name' => $request->category_name]);

             return redirect()->route('category.index');

           
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
        $category = Category::findOrFail($id);

        try 
        {
            $category->delete();
            return redirect()->route('category.index');
        } 
        catch (Exception $e) 
        {
            
        }
    }
}
