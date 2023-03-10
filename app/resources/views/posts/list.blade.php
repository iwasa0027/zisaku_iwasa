@extends('layouts.app')

@section('title', '投稿記事一覧')

@section('content')

<form method="POST" action="/post_list" >

<a href="/posts/create" class="btn btn-primary">新規投稿</a>

@if(count($posts) > 0)
  @foreach($posts as $post)
    <a href="/posts/{{$post->id}}">
      <div class="card my-3">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
          <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small>
          <p class="card-text">{{$post->image_path}}</p>
          <p class="card-text">{{$post->feelings}}</p>
        </div>
      </div>
    </a>
  @endforeach
@endif
@endsection