<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Notification;

use App\Notifications\FailedNegotiation;

// use Illuminate\Support\Facades\Notification;

class TestNotification extends Controller
{
    //

    public function test()
    {
        // code...
        // $user = User::first();

        // $contact_data = [
        //                         'user_name'=>'Irungu',
        //                         'user_email'=>'irungu@gmail.com',
        //                         'product_name'=>'adidas',
        //                         'percentage_discount'=>'10',
        //                         'thank_you'=>'Thank you for using this platform.',
        //                     ];

        // // $email_send = $user->notify(new FailedNegotiation($contact_data));

        // Notification::send($user, new FailedNegotiation($contact_data));

        return response()->json('sent');
    }

    public function index()
    {
        // code...

        if (Auth::user()->role_id == 1) 
        {
            $notification_count = Notification::where('merchant_id',Auth::user()->id)->count();
            $successful_negotiation = Notification::where('merchant_id',Auth::user()->id)
                                                    ->where('negotiation_status',1)
                                                    ->count();
            $cancelled_by_merchant = Notification::where('merchant_id',Auth::user()->id)
                                                    ->where('negotiation_status',2)
                                                    ->count();
            $cancelled_by_customer = Notification::where('merchant_id',Auth::user()->id)
                                                    ->where('negotiation_status',3)
                                                    ->count();
            $pending_negotiation = Notification::where('merchant_id',Auth::user()->id)
                                                    ->where('negotiation_status',0)
                                                    ->count();

            $notification_data = Notification::where('merchant_id',Auth::user()->id)
                                                ->with('customer')
                                                ->with('product')
                                                ->get();

            // return response()->json(['merchant_data',$notification_data]);

            return view('notification.merchant')->with('notification_count',$notification_count)
                                                ->with('successful_negotiation',$successful_negotiation)
                                                ->with('cancelled_by_merchant',$cancelled_by_merchant)
                                                ->with('cancelled_by_customer',$cancelled_by_customer)
                                                ->with('pending_negotiation',$pending_negotiation)
                                                ->with('notification',$notification_data);


        }
        else
        {
            $notification_count = Notification::where('customer_id',Auth::user()->id)->count();
            $successful_negotiation = Notification::where('customer_id',Auth::user()->id)
                                                    ->where('negotiation_status',1)
                                                    ->count();
            $cancelled_by_merchant = Notification::where('customer_id',Auth::user()->id)
                                                    ->where('negotiation_status',2)
                                                    ->count();
            $cancelled_by_customer = Notification::where('customer_id',Auth::user()->id)
                                                    ->where('negotiation_status',3)
                                                    ->count();
            $pending_negotiation = Notification::where('customer_id',Auth::user()->id)
                                                    ->where('negotiation_status',0)
                                                    ->count();

            $notification_data = Notification::where('customer_id',Auth::user()->id)
                                                ->with('merchant')
                                                ->with('product')
                                                ->get();

            // return response()->json(['customer_data',$notification_data]);

            return view('notification.customer')->with('notification_count',$notification_count)
                                                ->with('successful_negotiation',$successful_negotiation)
                                                ->with('cancelled_by_merchant',$cancelled_by_merchant)
                                                ->with('cancelled_by_customer',$cancelled_by_customer)
                                                ->with('pending_negotiation',$pending_negotiation)
                                                ->with('notification',$notification_data);

        }

    }

    public function store($merchant_id,$customer_id,$product_id,$discount,$status)
    {
        // code...

        $notification = new Notification;

        $notification->merchant_id = $merchant_id;
        $notification->customer_id = $customer_id;
        $notification->product_id = $product_id;
        $notification->discount_amount = $discount;
        $notification->negotiation_status = $status;

        $notification->save();

        return 1;

    }

    public function updateStatus($id, $status)
    {
        // code...

        $notification = Notification::findOrFail($id);

        if ($status == 1) 
        {
            // code...
            Notification::where('id',$id)->update(['negotiation_status'=>1]);
        }
        elseif($status == 2 && Auth::user()->role_id == 1) 
        {
            Notification::where('id',$id)->update(['negotiation_status'=>2]);
        }
        else
        {   
            Notification::where('id',$id)->update(['negotiation_status'=>3]);
        }

        return redirect()->back();

    }
}
