@extends('layouts.app')
@section('content')
@can('admin_only')
<h2>記事詳細</h2>

<div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    
                    <!-- Nested row for non-featured blog posts-->

                  
                    <div class="row">
               
                        <div class="col-lg-12">
                            <!-- Blog post-->
                          
                            <div class="card mb-4">
                         
                                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
                                <div class="card-body">
                                <h1 class="card-title h3">{{$post['title']}}</h1>
                                    <div class="small text-muted">投稿日：{{($post['created_at'])->format('Y/m/d')}}　
                                    <div class="small text-muted">編集日：{{($post['updated_at'])->format('Y/m/d')}}　
                                   
                             

                                  
                                
                                    
                                   
                                    </div>
                                    @foreach($post->tags as $tag)
                                  <a href="#!"> #{{ $tag->tag_name }}</a>
                                     @endforeach

                                    <p class="card-text">{!!nl2br(e($post['feelings']))!!}</p>
                                    
                                </div>            
                           
                            </div>
                            <button class="rounded-md bg-primary   px-4 py-2" onClick="history.back();">戻る</button> 
                        </div>
                    </div>
            
                    <!-- Pagination-->                         
                  
                    
                </div>
            </div>
        



</div>

@else
            <div class="text-center my-5">
    <p>ご不便をおかけして申し訳ございません。</p>
    <p class="lead">
    <a class="btn btn-primary" href="/" role="button">トップページへ戻る</a>
    </p>
@endcan

@endsection()
