<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;

class EmailController extends Controller
{
    public function sendEmail($id)
    {
        $userId = Auth::id();
        $subcategory = Subcategory::where('id', $id)->get(['id', 'name']);
        $user = User::where('id', $userId)->get(['id', 'name', 'email']);
        $stores = Store::where('status', '1')->get(['id', 'email']);

        /** 
         * Store a receiver email address to a variable.
         */
        //$reveiverEmailAddress = "azeez142111@gmail.com";

        /**
         * Import the Mail class at the top of this page,
         * and call the to() method for passing the 
         * receiver email address.
         * 
         * Also, call the send() method to incloude the
         * HelloEmail class that contains the email template.
        */

        foreach ($stores as $store)
        {
            Mail::to($store)->send(new OrderEmail($subcategory, $user));

            /* check for failures
            if (Mail::flushMacros()) {
                //return redirect()->route('home')->with('success', 'Your order has been sent successfully!');
                continue;
            }*/
            
            app('App\Http\Controllers\OrderController')->store($subcategory, $user, $store);
        }
        //Mail::to($reveiverEmailAddress)->send(new OrderEmail($subcategory, $user));

        /*
          Check if the email has been sent successfully, or not.
          Return the appropriate message.
         
        if (Mail::flushMacros() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
        */

        return redirect()->route('home')->with('success', 'Your order has been sent successfully!');
    }
}