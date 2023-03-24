<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = new Post;

      

        $per_page = 6; // １ページごとの表示件数
        $posts = \App\Post::paginate($per_page);

      
//dd($posts);
        return view('adminpost.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(INT $id,post $post)
    {
        $post= Post::find($id);

        return view('adminpost.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }


    public function index_crud(Request $request)
    {
     
    
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
                $query->where('title', 'like', '%'.$value.'%')

                ->orWhereHas('user', function ($query) use ($keyword){
                    $query->where('name', 'like', '%' .$keyword. '%');
                });

            }
            $posts = $query->paginate(2);
        }


      
            return view('adminpost.crud_index')
            ->with([
                'posts' => $posts,
                'keyword' => $keyword,
              
                
               
                
            ]);





}
}