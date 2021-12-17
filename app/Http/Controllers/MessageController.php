<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Redirect;
use Notification;

class MessageController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['message' => 'required']);
        $listing = Listing::findOrFail($request->listing_id);

        Message::create([
'user_id' => auth()->id(),
'listing_id' => $request->listing_id,
'message_text' => $request->message ,
]);
        $message = [
'name' => auth()->user()->name,
'email' =>auth()->user()->email,
'listingName' => $listing->title,
'messageText' => $request->message,


        ];
        Notification::route('mail' , $listing->user->email)
        ->notify(new MessageListingNotification($message));

        return Redirect::back()->with('success','Message Inserted in DB !');
    }

}
