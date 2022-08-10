<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sel($id){
        $find = User::find($id)->name;
        $rec = $find;
        $au = Auth::user()->name;
        $user = User::all();
        $chat = Chat::select('*')->where('send',$au)->orWhere('rec',$au)->get();
        return view('home',compact('user','chat','au','rec'));
    }
    public function sent(Request $request){

        // dd($request->send,$request->rec,$request->message);

        $request->validate([
            'message'=>'required'
        ]);
        $chat = new Chat;
        $chat->message = $request->message;
        $chat->send = $request->send;
        $chat->rec = $request->rec;
        $chat->save();

        return redirect()->back();
    }
}
