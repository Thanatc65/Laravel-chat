<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $rec = '';
        $au = Auth::user()->name;
        $user = User::all();
        $chat = Chat::select('*')->where('send',$au)->orWhere('rec',$au)->get();
        return view('home',compact('user','chat','au','rec'));
    }
}
