@extends('layouts.app')

@section('title', '投稿記事一覧')

@section('content')





<h3 class="fw-bolder mb-1">#{{ $tagword }}</h3>
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

                                     <p class="card-text">{{Str::limit($post->feelings, 40, '…' )}}</p>
                                
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
                  
            
                    {{ $posts->appends(request()->query())->links() }}
                   
                    <div class="text-center my-5">
                    <a href="{{ route('home')}}">
            <button type='button' class='btn btn-primary'>ホームに戻る</button></a>
                    </div>
                </div>
         
        </div>
        </div>
 <style>

  
   .col-lg-8{
   
   margin: auto;
    }


.card-text{
    margin-top: 10px;
}
.icon{
    color: yellow;
}
</style>
@endsection