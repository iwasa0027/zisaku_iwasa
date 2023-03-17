@extends('layouts.app')

@section('content')

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

 
 
     
   

        <!-- Page header with logo and tagline-->
        <header class="p-3 mb-2 bg-info border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">☆ようこそ！☆</h1>
                    <p class="lead mb-0">国内旅行記（ブログ）へ！</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
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
                          
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h2 class="card-title h4">{{$post->title}}</h2>
                                    <div class="small text-muted">{{($post->created_at)->format('Y/m/d')}}</div>
                                   
                                    <p class="card-text">{{$post->feelings}}</p>
                                    @foreach($post->tags as $tag)
                                  <a href=""> #{{ $tag->tag_name }}</a>
                                     @endforeach
                                    <br><a class="btn btn-primary" href="#">Read more →</a>
                                    
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
    <style>
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
                    {{$posts->links()}}
                    

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
                        <div class="card-header">ハッシュタグで探す</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">#桜</a></li>
                                        <li><a href="#!">#一人旅</a></li>
                                        <li><a href="#!">#夜景</a></li>
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



       
       <li><a class="tab-item{{ Request::is('bookmarks') ? ' active' : ''}}" href="{{ route('bookmarks') }}">ブックマーク</a></li>
                    <!-- Side widget-->
                   
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>





 </div>
            




@endsection
