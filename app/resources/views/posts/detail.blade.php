@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="card my-3">
      <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
        <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small>
        <a href="/posts/{{$post->id}}/edit">編集</a>

       
        <p class="card-text">{{$post->image_path}}</p>
        <img src="{{ asset($post->image_path) }}">
        <p class="card-text">{{$post->feelings}}</p>
      </div>
    </div>
@endsection
