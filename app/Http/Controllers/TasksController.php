<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Tasks;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Tasks::where('user_id',Auth::user()->id)->get();

        return response()->json($tasks);
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
                    'task_title'=>'required',
                    'deadline'=>'required',
                    'urgency'=>'required',
                    'status'=>'required',
                ];

        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
            return response()->json('validation failed');
        }
        else
        {
            try 
            {
                $tasks = new Tasks;
                $tasks->user_id = Auth::user()->id;
                $tasks->task_title = $request->input('task_title');
                $tasks->deadline = $request->input('deadline');
                $tasks->urgency = $request->input('urgency');
                $tasks->status = $request->input('status');

                $tasks->save();

                return redirect()->back()->with('success','task created');

            } 
            catch (Exception $e) 
            {
                return response()->json('error in creating task');
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
        $tasks = Tasks::findOrFail($id);

        return response()->json($tasks);
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
                    'tasks_title'=>'required',
                    'deadline'=>'required',
                    'urgency'=>'required',
                    'status'=>'required',
                ];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            // code...
            return response()->json('validation failed');
        }
        else
        {
            try 
            {
                $tasks = Tasks::where('id',$id)
                        ->update(
                        [
                            'tasks_title'=>$$request->input('tasks_title'),
                            'deadline'=>$request->input('deadline'),
                            'urgency'=>$request->input('urgency'),
                            'status'=>$request->input('status'),
                        ]); 
                
                return redirect()->back()->with('success','task created');
            } 
            catch (Exception $e) 
            {
                return response()->json('update error');
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
        $task = Tasks::findOrFail($id);

        try 
        {
           $task->delete();
           return redirect()->back()->with('success','deletion successful');
        } 
        catch (Exception $e) 
        {
            return response()->json('task deletion error');
        }
    }
}
