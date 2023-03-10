<?php

namespace App\Http\Controllers;

use App\Post;
use App\Posts;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$article = posts::orderBy('created_at', 'desc')->get();
        //$article = posts::all();
        $posts =Auth::User()->posts()->get();
        //dd($article);
        return view("posts.list",compact('posts'));

      
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$article = new posts();

       // Auth::User()->posts()->save($article);

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Posts;

         // ディレクトリ名
        $dir = 'images';
        // imagesディレクトリに画像を保存
        //$request->file('image_path')->store('public/' . $dir);

        // アップロードされたファイル名を取得
        $file_name = $request->file('image_path')->getClientOriginalName();
        // 取得したファイル名で保存
        $request->file('image_path')->resize(700,350)->storeAs('public/' . $dir, $file_name);
        $post->filename = $file_name;
        $post->image_path = 'storage/' . $dir . '/' . $file_name;
     
        $post->user_id=Auth::id();
        $post->title = $request->title;
        //$article->image_path = $request->image_path;
        $post->feelings = $request->feelings;

        $post->save();

        return redirect("/home");

     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function show(posts $post)
    {
        return view('posts.detail')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(posts $post)
    {
          return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posts $post)
    {

  // ディレクトリ名
  $dir = 'images';
  // imagesディレクトリに画像を保存
  //$request->file('image_path')->store('public/' . $dir);

  // アップロードされたファイル名を取得
  $file_name = $request->file('image_path')->getClientOriginalName();
  // 取得したファイル名で保存
  $request->file('image_path')->resize(700,350)->storeAs('public/' . $dir, $file_name);
  $post->filename = $file_name;
  $post->image_path = 'storage/' . $dir . '/' . $file_name;

        $post->title = $request->title;
        //$article->image_path = $request->image_path;
        $post->feelings = $request->feelings;
        $post->save();
        return redirect("/posts/{$post->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $post)
    {
        $post->delete();
        return redirect('/home');
    }
}
