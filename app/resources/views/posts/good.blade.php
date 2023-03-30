@extends('layouts.app')
@section('content')


<h3 class="fw-bolder mb-1">いいね一覧</h3>


 

<div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    
                    <!-- Nested row for non-featured blog posts-->

                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                            <!-- Post::where('user_id',Auth::id()) -->
                            <a  href="{{route('mypages.show',$post->user->id)}}">
                                投稿者：{{$post->user->name}}
                            </a>
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$post['title']}}</h1>
                                    <div class="small text-muted">{{($post['created_at'])->format('Y/m/d')}}</div>
                                    <p class="card-text">場所：{{$post->pref}}</p>
                                   
                             

                                     <p class="card-text">{{Str::limit($post->feelings, 30, '…' )}}</p>
                                
                                    <br><a class="btn btn-primary" href="{{route('posts.show',$post->id)}}"> 記事を読む →</a>
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$post['isLikedBy(Auth::user())'])
                                     <span class="likes">
                                            <i class=" fa-solid fa-star like-toggle icon" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <i class="fa-solid fa-star heart like-toggle  " data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                    @endauth
                                    @guest
                                    <span class="likes">
                                        <i class="fa-solid fa-star heart"></i>
                                        <span class="like-counter">{{$post['likes_count']}}</span>
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
                    <div class="text-center my-5">
                    <a href="{{ route('mypages.index')}}">
            <button type='button' class='btn btn-primary'>マイページに戻る</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagetop">Topに戻る</div>
<style>


.icon{
    color: yellow;
}

body{
        background: #DFEFF2;
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
  background: #FF9900;
  
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

@endsection()