<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function User()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo('App\User');
    }
    public function posts()
    {   //postsテーブルとのリレーションを定義するreviewメソッド
        return $this->belongsTo('App\posts');
    }
}
