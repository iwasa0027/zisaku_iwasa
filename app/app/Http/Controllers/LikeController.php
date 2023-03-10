<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Posts;
use App\Like;

class LikeController extends Controller
{
    //いいねをつける
    public function like(Posts $post){
        $like = New Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        
        return back();
    }

     // いいねを表示するページ
     public function index(Posts $post)
     {
         $posts = Posts::all();
         $user = Auth::user();
         $nice = Like::where('post_id', $post->id)->where('user_id', $user)->first();
         return view('home',compact('post','like','user'));
     }
}
