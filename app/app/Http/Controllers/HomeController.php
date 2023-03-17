<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

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
    public function index(Request $request)
    {
        $post =Auth::User()->posts()->get();
        $sort=$request->sort;
        $products=Post::orderBy('created_at', 'desc')->paginate(4);

        return view('home',['posts' => $post, 'sort'=>$sort,'posts'=>$products]);
    }
    
}
