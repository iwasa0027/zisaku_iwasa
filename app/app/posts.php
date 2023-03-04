<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $fillable = ['title','feelings'];

    public function type(){
        return $this->belongsTo('App\users','user_id','id');
    }
}