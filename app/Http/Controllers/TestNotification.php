<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Notifications\FailedNegotiation;

use Illuminate\Support\Facades\Notification;

class TestNotification extends Controller
{
    //

    public function test()
    {
        // code...
        $user = User::first();

        $contact_data = [
                                'user_name'=>'Irungu',
                                'user_email'=>'irungu@gmail.com',
                                'product_name'=>'adidas',
                                'percentage_discount'=>'10',
                                'thank_you'=>'Thank you for using this platform.',
                            ];

        // $email_send = $user->notify(new FailedNegotiation($contact_data));

        Notification::send($user, new FailedNegotiation($contact_data));

        return response()->json('sent');
    }
}
