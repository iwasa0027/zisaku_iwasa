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
                            <a  href="{{route('mypages.show',$post->user->id)}}">
                                投稿者：{{$post->user->name}}
                            </a>
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$post['title']}}</h1>
                                    <div class="small text-muted">{{($post['created_at'])->format('Y/m/d')}}　
                                   
                             

                                  
                                
                                    
                                    @auth
                                     <!-- //いいねを付ける記述を修正しています -->
                                     @if (!$post['isLikedBy(Auth::user())'])
                                     <span class="likes">
                                            <i class=" fa-regular fa-star like-toggle" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <i class="fa-solid fa-star heart like-toggle  icon" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post['likes_count']}}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                    @endauth
                                    @guest
                           
                                    @endguest
                                    </div>
                                    <p class="card-text">{{$post['feelings']}}</p>
                                </div>             
                            </div>
                        </div>
                    </div>
            
                    <!-- Pagination-->                         
                  
                    
                </div>
            </div>
        


<button class="rounded-md bg-gray-800 text-blue px-4 py-2" onClick="history.back();">戻る</button>
</div>
<style>
  


.icon{
    color: yellow;
}
</style>

@endsection()
