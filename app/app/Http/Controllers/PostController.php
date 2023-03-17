<?php

namespace App\Http\Controllers;

use App\Post;
use App\Article;
use App\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $posts = Post::paginate(20);
        $keyword = $request->input('keyword');

        $query = Post::query();



        if($keyword) {
            // $query->where('title', 'LIKE', "%{$keyword}%")
            //     ->orWhere('feelings', 'LIKE', "%{$keyword}%");

             // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('title', 'like', '%'.$value.'%')->orWhere('feelings', 'like', '%'.$value.'%');
            }
            $posts = $query->paginate(20);
        }
            return view('posts.list')
            ->with([
                'posts' => $posts,
                'keyword' => $keyword,
            ]);



        //$posts =Auth::User()->Posts()->orderBy('created_at', 'desc')->paginate(5);
        
        //$posts = $query->get();

        //return view("posts.list",compact('posts','keyword'));
        
      
        
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
        $post = new Post;

            // preg_match_allを使用して#タグのついた文字列を取得している
       preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u', $request->tags, $match);
       $tags = [];
       
       // $matchの中でも#が付いていない方を使用する(配列番号で言うと1)
       foreach($match[1] as $tag) {
           // firstOrCreateで重複を防ぎながらタグを作成している。
           $record = Tag::firstOrCreate(['tag_name' => $tag]);
           array_push($tags, $record);
       }
       
       $tags_id = [];
       foreach($tags as $tag) {
           array_push($tags_id, $tag->id);
       }



         // ディレクトリ名
        $dir = 'images';
        // imagesディレクトリに画像を保存
        //$request->file('image_path')->store('public/' . $dir);

        // アップロードされたファイル名を取得
        $file_name = $request->file('image_path')->getClientOriginalName();
        // 取得したファイル名で保存
        $request->file('image_path')->storeAs('public/' . $dir, $file_name);
        $post->filename = $file_name;
        $post->image_path = 'storage/' . $dir . '/' . $file_name;
     
        $post->user_id=Auth::id();
        $post->title = $request->title;
        //$article->image_path = $request->image_path;
        $post->feelings = $request->feelings;

        $post->save();

        $post->tags()->attach($tags_id);

        return redirect("/home");

     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.detail')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
          return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
              // preg_match_allを使用して#タグのついた文字列を取得している
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        $before = [];
        foreach($post->tags as $tag){
            array_push($before, $tag->name);
        }
        $after = [];
        foreach($match[1] as $tag){
            // 普通に新しいのが来たら新規作成する動き
            $record = Tag::firstOrCreate(['tag_name' => $tag]);
            array_push($after, $record);
        }
 
        $tags_id = [];
         foreach($after as $tag) {
             array_push($tags_id, $tag->id);
         }
         $post->tags()->sync($tags_id); //ここが重要です。
      

  // ディレクトリ名
  $dir = 'images';
  // imagesディレクトリに画像を保存
  //$request->file('image_path')->store('public/' . $dir);

  // アップロードされたファイル名を取得
  $file_name = $request->file('image_path')->getClientOriginalName();
  // 取得したファイル名で保存
  $request->file('image_path')->storeAs('public/' . $dir, $file_name);
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/home');
    }
}
