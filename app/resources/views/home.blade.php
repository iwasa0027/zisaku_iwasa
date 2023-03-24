

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
                   
                   <img src="{{ asset('image/sample.png')}}" id="slide_img" class="slider" />
                 
                      
                      
                   </div>
               
<style>
    img{
        width: 40%;
    }
</style>
<script>
 const img_src = ["{{ asset('image/thumbnail_image004.jpg')}}","{{ asset('image/thumbnail_image005.jpg')}}","{{ asset('image/thumbnail_image006.jpg')}}" ];
      let num = -1;

      function slide_time() {
        if (num === 2) {
          num = 0;
        } else {
          num++;
        }
        document.getElementById("slide_img").src = img_src[num];
      
      }

      setInterval(slide_time, 1300);

      


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
                                   
                                    @foreach($product->tags as $tag)
                                  <a href="#!"> #{{ $tag->tag_name }}</a>
                                     @endforeach

                                     <p class="card-text">{{Str::limit($product->feelings, 40, '…' )}}</p>
                                
                                    <br><a class="btn btn-primary" href="{{route('posts.show',$product->id)}}"> 記事を読む →</a>
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$product->isLikedBy(Auth::user()))
                                     <span class="likes">
                                            <i class=" fa-regular fa-star like-toggle" data-post-id="{{ $product->id }}"></i>
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
                        <div class="card-header">検索</div>
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
                        <div class="card-header">おすすめ検索</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    
                                    <ul class="list-unstyled mb-0">
                                       <li> <a href="/posts?keyword=宮城">・宮城</a></li>                                  
                                        <li><a href="/posts?keyword=桜">・桜</a></li>
                                        <li><a href="/posts?keyword=夜景">・夜景</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="/posts?keyword=香川">・香川</a></li>
                                        
                                        <li><a href="/posts?keyword=一人旅">・一人旅</a></li>
                                        <li><a href="/posts?keyword=花">・花</a></li>
                                    </ul>
                                </div>
                               
                            </div>
                            
                        </div>


                    </div>





                    <div class='row justify-content-around mt-3'>
        <a href="{{route('posts.create')}}">
            <button type='button' class='btn btn-primary'>新規投稿ページ</button>
       </a></div> 

       <div class='row justify-content-around mt-3'>
       <a href="{{route('posts.store')}}">
            <button type='button' class='btn btn-primary'>リスト確認</button>
       </a></div> 

       <div class='row justify-content-around mt-3'>
       <a href="{{ route('mypages.index')}}">
            <button type='button' class='btn btn-primary'>マイページ</button>
       </a></div> 
      



       
    
                    <!-- Side widget-->
                   
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
    



 </div>
 
@elsecan('admin_only')

<p>管理者専用ページ</p>
<p>ユーザー情報</p>
<div class='row justify-content-around mt-3'>
       <a href="{{route('adminuser.index')}}">
            <button type='button' class='btn btn-primary'>ユーザー情報</button>
       </a></div> 
<p>投稿情報</p>
<div class='row justify-content-around mt-3'>
       <a href="{{route('adminpost.index')}}">
            <button type='button' class='btn btn-primary'>投稿情報</button>
       </a></div> 


@endcan
@endsection

