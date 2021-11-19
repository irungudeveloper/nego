<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
     public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) 
        {
            return redirect()->intended('dashboard');
        }
  
        return redirect()->route('login')->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('account');
    }

    public function merchant()
    {
        return view('vendor.adminlte.auth.merchant_register');
    }
     
     public function customer()
    {
        return view('vendor.adminlte.auth.customer_register');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'first_name' => 'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id'=>'required'
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'first_name' => $data['first_name'],
        'last_name'=>$data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role_id'=>$data['role_id']
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('home');
        }
  
        return redirect()->route('login')->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login');
    }
}
