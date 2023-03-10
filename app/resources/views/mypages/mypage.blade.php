@extends('layouts.app')



@section('content')

<form method="POST" action="{{route('mypages.index')}}"  enctype="multipart/form-data">



<div class="profile_box">
<div class="box-title">マイページ</div>
<div class="profile_center">
<p class="card-text"><img src="{{ asset('storage/images/IMG_3894.JPG') }}" alt="" class="profile_figure"></p>

<div class="profile_name">名前</div></div>
<p>プロフィール<br>{{ $mypage->profile }}</p>
<!-- <p class="profile_center" name="profile" placeholder="感想やご意見" cols="50" rows="20" /></p> -->



<div class='row justify-content-around mt-3'>
        <a href="{{route('articles.create')}}">
            <button type='button' class='btn btn-primary'>新規投稿ページ</button>
       </a></div> 

       <div class='row justify-content-around mt-3'>
        <a href="{{route('mypages.edit',auth()->user()->id)}}">
            <button type='button' class='btn btn-primary'>ユーザー編集</button>
       </a></div> 

</div>




<style>
/*枠デザイン*/

.profile_box{
margin: 2em 0;
padding: 1em;
background: radial-gradient(#edcccc, #eb8686);
}
.profile_box .box-title {
font-size: 18px;
line-height:1.8;
background: #e86464; /*タイトルの背景色*/
padding: 4px;
text-align: center;
color: #FFF; /*文字色*/
font-weight: bold;
letter-spacing: 0.05em;
border-radius: 8px;
}
/*内容*/
.profile_center{
text-align: center;
margin: 10px 15px 0 0;
}
/*プロフィール画像*/
.profile_figure {
width:150px;
height:150px;
border-radius: 50%; /*丸くする*/
border: solid 3px #e86464; /*枠線*/
}
/*名前*/
.profile_name {
padding: 15px 20px;
font-weight:bold;
font-size:16px;
}
/*自己紹介文*/
.profile_box p {
padding: 15px 20px;
margin: 0;
}


</style>









@endsection 