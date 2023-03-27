<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;

use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = new User;

        $per_page = 10; // １ページごとの表示件数
        $users = \App\User::paginate($per_page);

        $users = User::withCount('posts')->paginate($per_page);
   
       
        return view('adminuser.index')->with('users', $users);
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
        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        

        return redirect('/user.index',['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, User $user)
    {
      

        $user= User::find($id);

        $per_page = 5; // １ページごとの表示件数
    

       
        //$posts=Post::where( optional($user->post)->user_id())->get();
        $posts=Post::where('user_id',$id)->orderBy('created_at', 'desc')->paginate($per_page);
      
        //$posts=Post::where( optional($user->user)->id())->where('user_id',Auth::id())->get();
       
     

        return view('adminuser.show',['users' => $user,'posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
       //
    }

    public function user_index_crud(Request $request)
    {
     
        $users = new User;

        $per_page = 2; // １ページごとの表示件数
        $users = \App\User::paginate($per_page);

        $users = User::withCount('posts')->get();

        $keyword = $request->input('keyword');
       
        $query = User::query();

        if($keyword) {
            // $query->where('title', 'LIKE', "%{$keyword}%")
            //     ->orWhere('feelings', 'LIKE', "%{$keyword}%");

             // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%')
                ->orWhere('email', 'like', '%'.$value.'%');
            }
            $users = $query->orderBy('created_at', 'asc')->withCount('posts')->paginate(10);
         
        }

       
      

        


      
            return view('adminuser.user_crud_index')
            ->with([
                'users' => $users,
                'keyword' => $keyword,
              
                
               
                
            ]);





}
}
