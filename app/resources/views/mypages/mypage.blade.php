@extends('layouts.app')



@section('content')

<form method="POST" action="{{route('mypages.index')}}"  enctype="multipart/form-data">



<div class="profile_box">
    <div class="box-title">マイページ</div>
    <div class="profile_center">
        <p class="card-text"><img src="{{ asset($mypage->image)}}" alt="....." class="profile_figure"></p>

        <div class="profile_name"><span>{{$mypage->name}}</span></div><br>
    </div>
        <div class="profile_name"><span>プロフィール</span></div><br>
        <div class="profile_name"><span>{{$mypage->profile}}</span></div><br>
        <!-- <p class="profile_center" name="profile" placeholder="感想やご意見" cols="50" rows="20" /></p> -->



        <div class='row justify-content-around mt-3'>
        <a href="{{route('posts.create')}}">
            <button type='button' class='btn btn-primary'>新規投稿ページ</button>
       </a></div> 

       <div class='row justify-content-around mt-3'>
        <a href="mypages/{{$mypage->id}}/edit">
            <button type='button' class='btn btn-primary'>ユーザー編集</button>
       </a></div> 

       @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                          
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h2 class="card-title h4">{{$post->title}}</h2>
                                    <div class="small text-muted">{{($post->created_at)->format('Y/m/d')}}</div>
                                   
                                    <p class="card-text">{{$post->feelings}}</p>
                                    @foreach($post->tags as $tag)
                                  <a href=""> #{{ $tag->tag_name }}</a>
                                     @endforeach
                                     @endforeach
                                     @endif
       
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