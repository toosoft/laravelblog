<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class apiMessageController extends Controller
{
    public function create(Request $request) {

        $message = Message::create($request->all());
        return $message;


        //$message = new Message();

        // $message->title = $request->title;
        // $message->content = $request->content;

        // $message->save();

        //return $message::all();

        // foreach($message as $message)//
        // {//
        //     return ['title' => $message->title, 'content' => $message->content];//
        // }//

        //return ['title' => $message->title, 'content' => $message->content];


        //return redirect('/');

    }

    public function createBlog(Request $request) {

        $message = new Message();

        $message->title = $request->title;
        $message->content = $request->content;

        $message->save();
        return ["message" => "New blog Added!"];

//        return redirect('/blog');

    }


    public function show() {


        $message = new Message();

        return $message::all();

        //return view('message', ['message' => $message]);

    }

    public function view($id) {

        $message = Message::findOrFail($id);
        return $message;


        //return ['title' => $message->title, 'content' => $message->content];

    }

    public function update(Request $request, $id) {

        $message = Message::find($id);
        $message->update($request->all());
        return $message;

    }

    public function destroy($id) {

        return Message::destroy($id);

    }

    public function search($title) {

        return Message::where('title', 'like', '%'.$title.'%')->get();

    }
}
