<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    //後でViewで使う、いいねされているかを判定するメソッド。
   


    protected $fillable = ['title',"image_path",'feelings','filename'];

    public function user()
    {
        //Userモデルのデータを取得する
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }

    
    public function tags()
{
	return $this->belongsToMany('App\Tag','post_tag');
}
}