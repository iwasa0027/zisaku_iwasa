<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
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
    
}