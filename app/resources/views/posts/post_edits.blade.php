@extends('layouts.app')
@section('content')

 

<div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    
                    <!-- Nested row for non-featured blog posts-->

                  
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                            <!-- Post::where('user_id',Auth::id()) -->
                          
                                <a href="#!"><img class="card-img-top" src="{{ asset($posts->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$posts['title']}}</h1>
                                   
                                   
                             

                                  
                                
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$posts['isLikedBy(Auth::user())'])
                                     <span class="likes">
                                            <i class=" fa-regular fa-star like-toggle" data-post-id="{{ $posts->id }}"></i>
                                        <span class="like-counter">{{$posts['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <i class="fa-solid fa-star heart like-toggle  icon" data-post-id="{{ $posts->id }}"></i>
                                        <span class="like-counter">{{$posts['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                    @endauth
                                    @guest
                           
                                    @endguest
                                    </div>
                                    <p class="card-text">{{$posts['feelings']}}</p>
                                </div>             
                            </div>
                        </div>
                    </div>
            
                    <!-- Pagination-->                         
                  
                    
                </div>
            </div>
        </div>
</div>
<a  href="/home">ホームに戻る</a>

<style>
    .icon{
    color: yellow;
}
</style>

@endsection()