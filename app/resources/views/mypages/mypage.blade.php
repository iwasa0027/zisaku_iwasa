@extends('layouts.app')


@section('title', 'ユーザー情報')
@section('content')



<form method="POST" action="{{route('mypages.index')}}" >



<div class="profile_box">
    <div class="box-title">マイページ</div>
    <div class="profile_center">
        <p class="card-text"><img src="{{ asset($mypage->image)}}" alt="....." class="profile_figure"></p>

        <div class="profile_name"><span>{{$mypage->name}}</span></div><br>
    </div>
        <div class="profile_name"><span><プロフィール></span></div>
        <div class="profile_name"><span>{!!nl2br(e($mypage->profile))!!}</span></div><br>



    
        <div class="profile_center">

       <a href="mypages/{{$mypage->id}}/edit" class="mypage1">
            <button type='button' class='btn btn-primary'>ユーザー編集</button>
       </a>
  
       <a href="{{ route('bookmarks') }}" class="mypage1">
            <button type='button' class='btn btn-primary'>いいね一覧</button>
       </a>
        </div>
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
                         
                               <img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." />
                                <div class="card-body">
                                <h1 class="card-title h3">{{$post->title}}</h1>
                                    <div class="small text-muted">{{($post->created_at)->format('Y/m/d')}}
                                  

                                    <a  href="{{route('posts.edit',$post->id)}}">
                                        編集
                                    </a>
                                   </div>
                                   <p class="card-text">場所：{{$post->pref}}</p>
                                    @foreach($post->tags as $tag)
                                  <a href="#!"> #{{ $tag->tag_name }}</a>
                                     @endforeach

                                     <p class="card-text">{{Str::limit($post->feelings, 20, '…' )}}</p>
                                
                                    <br><a class="btn btn-primary" href="{{route('posts.show',$post->id)}}"> 記事を読む →</a>
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$post->isLikedBy(Auth::user()))
                                     <span class="likes">
                                            <i class=" fa-solid fa-star like-toggle" data-post-id="{{ $post->id }}"></i>
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
                  
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
</div>
<div class="pagetop">Topに戻る</div>
<style>
.p-3{
    margin-top: 50px;
}

body{
    background-color: #e86464;
}


.col-lg-8{
   
    margin: auto;
}



        .card-text{
            margin-top: 10px;
        }
        .icon{
            color: yellow;
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

.pagetop {
  cursor: pointer;
  position: fixed;
  right: 30px;
  bottom: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  transition: .3s;
  color: #000080;
  background: #33FF00;
  
/*   デフォルトは非表示 */
  opacity: 0;
}
.pagetop:hover {
    box-shadow: 0 0 10px #000080;
}

</style>

<script>
const pagetop_btn = document.querySelector(".pagetop");

// .pagetopをクリックしたら
pagetop_btn.addEventListener("click", scroll_top);

// ページ上部へスムーズに移動
function scroll_top() {
  window.scroll({ top: 0, behavior: "smooth" });
}

// スクロールされたら表示
window.addEventListener("scroll", scroll_event);
function scroll_event() {
  if (window.pageYOffset > 100) {
    pagetop_btn.style.opacity = "1";
  } else if (window.pageYOffset < 100) {
    pagetop_btn.style.opacity = "0";
  }
}

</script>

@endsection 