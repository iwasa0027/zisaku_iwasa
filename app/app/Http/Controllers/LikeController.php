<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;

class LikeController extends Controller
{

    //いいねをつける
    public function like(Request $request){
        $user_id = Auth::user()->id; //ログインユーザーのid取得
        $post_id = $request->post_id; //投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();

        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
            //5.この投稿の最新の総いいね数を取得
     $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
     $param = [
         'post_likes_count' => $post_likes_count,
     ];
     return response()->json($param); //6.JSONデータをjQueryに返す
}


    // いいねを表示するページ
public function index(Request $request)
{
    $posts = Post::withCount('likes')->orderBy('id', 'desc')->paginate(10);
    $param = [
        'posts' => $posts,
    ];
    return view('home', $param);
}


}