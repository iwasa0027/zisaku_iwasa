<?php

namespace App\Http\Controllers;

use App\Mypage;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\MypageData;


use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $mypage =Auth::user();

        $sort=$request->sort;
        $posts=Post::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(2);
        return view("mypages.mypage",['mypage' => $mypage,'sort'=>$sort,'posts'=>$posts ]);

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

        $mypage=new User;
        $mypage->profile = $request->profile;

        $mypage->save();
        return redirect("/mypages");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function show(User $mypage)
    {
        $post=Post::where('user_id',Auth::id())->get();//自分のみのを持ってくる

        
        return view('mypages.mypage_show',['mypage' => $mypage,'posts'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function edit(User $mypage)
    {
        $post=Post::where('user_id',Auth::id())->get();//自分のみのを持ってくる
        $mypage=Auth::user();
        return view('/mypages.mypage_edit',['mypage' => $mypage,'posts'=>$post,'auth'=>$mypage ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function update(MypageData $request, User $mypage)
    {

// 対象レコード取得

// $mypage= User::find($mypage);

// // リクエストデータ受取

// $form = $request->all();

// // フォームトークン削除

// unset($form['_token']);


    
        // // ディレクトリ名
           $dir = 'userimages';
        // //  // imagesディレクトリに画像を保存
          // $request->file('image')->store('public/' . $dir);

        // // // アップロードされたファイル名を取得
         $file_name = $request->file('image')->getClientOriginalName();
        // // // 取得したファイル名で保存
          $request->file('image')->storeAs('public/' . $dir, $file_name);
         $mypage->filename = $file_name;
          $mypage->image = 'storage/' . $dir . '/' . $file_name;


       
        
        $mypage->password = $request->password;
        $mypage->name= $request->name;
        $mypage->email = $request->email;
        $mypage->profile = $request->profile;
    

        $mypage->save();
        return redirect("/mypages");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $mypage)
    {
        
            $mypage->delete();
            return redirect('/login');
        
    }
}
