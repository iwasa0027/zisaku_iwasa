

@extends('layouts.app')

@section('content')

@can ('users')
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <link href="css/styles.css" rel="stylesheet" />
 
                 
                  
   

        <!-- Page header with logo and tagline-->
        <header class="p-3 mb-2 bg-info border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                     <h3> {{ Auth::user()->name }}さん!</h3>
                    <h1 class="fw-bolder">☆ようこそ！☆</h1>
                   
                    <p class="lead mb-0">国内旅行記（ブログ）へ！</p>
                </div>


             

            </div>
        </header>
       
        <div class="text-center my-5">
                   
                   <img src="{{ asset('image/bbbbbb.jpg')}}" id="slide_img" class="slider" width="45%">
                 
                      
                      
                   </div>
               

<script>
 const img_src = ["{{ asset('image/aaaaa.jpg')}}","{{ asset('image/thumbnail_image005.jpg')}}","{{ asset('image/ccccc.jpg')}}","{{ asset('image/thumbnail_image012.jpg')}}","{{ asset('image/bbbbbb.jpg')}}" ];
      let num = -1;

      function slide_time() {
        if (num === 4) {
          num = 0;
        } else {
          num++;
        }
        document.getElementById("slide_img").src = img_src[num];
      
      }

      setInterval(slide_time, 1500);

      


</script>
       

        <h3 class="fw-bolder mb-1">新規投稿一覧</h3>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    
                    <!-- Nested row for non-featured blog posts-->

                    @if(count($products) > 0)
                    @foreach($products as $product)
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                            <!-- Post::where('user_id',Auth::id()) -->
                           
                            <a  href="{{route('mypages.show',$product->user->id)}}">
                            投稿者：{{$product->user->name}}
                            </a>
                                <a href="#!"><img class="card-img-top" src="{{ asset($product->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$product->title}}</h1>
                                    <div class="small text-muted">{{($product->created_at)->format('Y/m/d')}}</div>
                                    <p class="card-text">場所：{{$product->pref}}</p>
                                   
                                    @foreach($product->tags as $tag)
                                  <a href="{{ route('tagword',['tagword'=>$tag->tag_name])}}"> #{{ $tag->tag_name }}</a>
                                     @endforeach

                                                            
                                   
                                
                                                                        
                                     <p class="card-text">{{Str::limit($product->feelings, 20, '…' )}}</p>
                                
                                    <br><a class="btn btn-primary" href="{{route('posts.show',$product->id)}}"> 記事を読む →</a>
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$product->isLikedBy(Auth::user()))
                                     <span class="likes">
                                            <i class=" fa-solid fa-star like-toggle" data-post-id="{{ $product->id }}"></i>
                                        <span class="like-counter">{{$product->likes_count}}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <i class="fa-solid fa-star heart like-toggle  icon" data-post-id="{{ $product->id }}"></i>
                                        <span class="like-counter">{{$product->likes_count}}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                    @endauth
                                    @guest
                                    <span class="likes">
                                        <i class="fa-solid fa-star heart"></i>
                                        <span class="like-counter">{{$product->likes_count}}</span>
                                    </span><!-- /.likes -->
                                    @endguest
                                </div>
    <style>

        .card-text{
            margin-top: 10px;
        }
        .icon{
            color: yellow;
        }
    </style>
             
                            </div>
                        </div>
                    </div>
                   @endforeach
                   @endif       
                 
                    <!-- Pagination-->                         
                  
                    {{ $products->links() }}

                    <!-- <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav> -->
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">フリーワード検索</div>
                        <div class="card-body">
                            <div class="input-group">
                         <div>
                            <form action="{{ route('posts.index') }}" method="GET">
                                <input type="search" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                                <input type="submit" value="検索">
                            </form>
                            
                        </div>

                     
                             
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">人気ワード検索</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    
                                    <ul class="list-unstyled mb-0">
                                       <li> <a href="{{ route('posts.index',['keyword'=>'宮城'])}}">・宮城</a></li>                                  
                                        <li><a href="{{ route('posts.index',['keyword'=>'桜'])}}">・桜</a></li>
                                        <li><a href="{{ route('posts.index',['keyword'=>'夜景'])}}">・夜景</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{ route('posts.index',['keyword'=>'香川'])}}">・香川</a></li>
                                        
                                        <li><a href="{{ route('posts.index',['keyword'=>'一人旅'])}}">・一人旅</a></li>
                                        <li><a href="{{ route('posts.index',['keyword'=>'花'])}}">・花</a></li>
                                    </ul>
                                </div>
                               
                            </div>
                            
                        </div>


                    </div>



 
                    <div class="card mb-4">
                        <div class="card-header">場所から探す</div>
                        <div class="card-body">
                            <div class="input-group">
                         <div>
                            <form action="{{ route('basyoword') }}" method="GET">

                            <select type="submit"  name='basyoword'  value="@if (isset($basyoword)) {{ $basyoword }} @endif">                         
                                @foreach(config('pref') as $pref => $score)
                                    <option value="{{ $score }}">{{ $score }}</option>
                                @endforeach     <input type="submit" value="検索">
                            </select>
                                <!-- <input type="search" name="basyoword" value="@if (isset($basyoword)) {{ $basyoword }} @endif"> -->
                            </form>
                            
                        </div>

                     
                             
                            </div>
                        </div>
                    </div>



                    <div class="card mb-4">
                        <div class="card-header">おすすめハッシュタグ</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    
                                    <ul class="list-unstyled mb-0">
                                       <li> <a href="{{ route('tagword',['tagword'=>'宮城'])}}">#宮城</a></li>                                  
                                        <li><a href="{{ route('tagword',['tagword'=>'桜'])}}">#桜</a></li>
                                        <li><a href="{{ route('tagword',['tagword'=>'夜景'])}}">#夜景</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{ route('tagword',['tagword'=>'香川'])}}">#香川</a></li>
                                        
                                        <li><a href="{{ route('tagword',['tagword'=>'一人旅'])}}">#一人旅</a></li>
                                        <li><a href="{{ route('tagword',['tagword'=>'花'])}}">#花</a></li>
                                    </ul>
                                </div>
                               
                            </div>
                            
                        </div>


                    </div>







       
    
                    <!-- Side widget-->
                   
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white"> Your Website 2022</p></div>
        </footer>
    

        <div class="pagetop">Topに戻る</div>

 </div>
 
 <style>
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




@elsecan('admin_only')


<header class="p-3 mb-4 border-bottom mb-4">
<div class="container">
                <div class="text-center my-5">
<h3>管理者専用ページ</h3>
                </div>
</div>
</header>


<div class="text-center my-5">

       <a href="{{route('adminuser.index')}}">
            <button type='button' class='btn btn-primary'>ユーザー情報</button>
       </a>
</div>

<div class="text-center my-5">

       <a href="{{route('adminpost.index')}}">
            <button type='button' class='btn btn-primary'>投稿情報</button>
       </a>
</div>

<style>
    body{
        background: #DFEFF2;
    }
</style>
@endcan
@endsection

