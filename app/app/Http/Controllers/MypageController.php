<?php

namespace App\Http\Controllers;

use App\Mypage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =Auth::id();
        $mypage=DB::table('users')->find($id);
        return view("mypages.mypage")->with(['mypage' => $mypage ]);

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
        //return view('mypages.edit')->with('mypage', $mypage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function edit(User $mypage)
    {
        return view('mypages.mypage_edit')->with('mypage', $mypage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $mypage)
    {
        // ディレクトリ名
        //  $dir = 'userimages';
        //  // imagesディレクトリに画像を保存
        //  //$request->file('image_path')->store('public/' . $dir);

        // // アップロードされたファイル名を取得
        // $file_name = $request->file('image')->getClientOriginalName();
        // // 取得したファイル名で保存
        // $request->file('image')->storeAs('public/' . $dir, $file_name);
        // $mypage->filename = $file_name;
        // $mypage->image_path = 'storage/' . $dir . '/' . $file_name;


        //$mypage->image = $request->image;
        $mypage->profile = $request->profile;

        $mypage->save();
        return redirect("mypages.mypage");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mypage  $mypage
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $mypage)
    {
        //
    }
}
