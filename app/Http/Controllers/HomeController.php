<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        // foreach($messages as $message)
        // {
        //     echo $message->title;
        // }

        return view('hello');
    }

    public function blog(Request $request)
    {
        $user = $request->user();

        $messages = Message::all();

        // foreach($messages as $message)
        // {
        //     echo $message->title;
        // }

//        return $user;
        return view('home', ['messages' => $messages]);
    }
}
