@extends('layouts.app')


@section('title', 'ユーザー情報')
@section('content')

<div class="profile_box">
    <div class="box-title">マイページ</div>
    <div class="profile_center">
        <p class="card-text"><img src="{{ asset($mypage->image)}}" alt="....." class="profile_figure"></p>

        <div class="profile_name"><span>{{$mypage->name}}</span></div><br>
    </div>
        <div class="profile_name"><span>プロフィール</span></div><br>
        <div class="profile_name"><span>{{$mypage->profile}}</span></div><br>
        <!-- <p class="profile_center" name="profile" placeholder="感想やご意見" cols="50" rows="20" /></p> -->


        <header class="p-3 mb-2 bg-secondary border-bottom mb-4" >
            <div class="container">
                <div class="text-center my-5">
                   
                    <h4 class="fw-bolder">投稿一覧</h4>
                   
                
                </div>
            </div>
        </header>


       <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    
                    <!-- Nested row for non-featured blog posts-->

                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                            <!-- Post::where('user_id',Auth::id()) -->
                            <a  href="{{route('mypages.show',$post->user->id)}}">
                                {{$post->user->name}}
                            </a>
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$post->title}}</h1>
                                    <div class="small text-muted">{{($post->created_at)->format('Y/m/d')}}</div>
                                   
                                    @foreach($post->tags as $tag)
                                  <a href="#!"> #{{ $tag->tag_name }}</a>
                                     @endforeach

                                     <p class="card-text">{{$post->feelings}}</p>
                                
                                    <br><a class="btn btn-primary" href="{{route('posts.show',$post->id)}}"> 記事を読む →</a>
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$post->isLikedBy(Auth::user()))
                                     <span class="likes">
                                            <i class=" fa-regular fa-star like-toggle" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post->likes_count}}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <i class="fa-solid fa-star heart like-toggle  icon" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post->likes_count}}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                    @endauth
                                    @guest
                                    <span class="likes">
                                        <i class="fa-solid fa-star heart"></i>
                                        <span class="like-counter">{{$post->likes_count}}</span>
                                    </span><!-- /.likes -->
                                    @endguest
                                </div>             
                            </div>
                        </div>
                    </div>
                   @endforeach
                   @endif       
                 
                    <!-- Pagination-->                         
                  
                
                </div>
            </div>
        </div>
</div>

                  
<style>
      .card-text{
            margin-top: 10px;
        }
        .icon{
            color: yellow;
        }
    .col-lg-8{
   
   margin: auto;
    }
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