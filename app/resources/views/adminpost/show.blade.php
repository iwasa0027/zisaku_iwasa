@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <div class="card my-3">
      <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p>@foreach($post->tags as $tag)
          <a href="#"> #{{ $tag->tag_name }}</a>
           @endforeach</p>
   
    
        <!-- <a href="/posts/{{$post->id}}/edit">編集</a> -->

        <img src="{{ asset($post->image_path) }}">
        <p class="card-text">{{$post->feelings}}</p>
      </div>
    </div>

    <button class="rounded-md bg-gray-800 text-blue px-4 py-2" onClick="history.back();">戻る</button>
@endsection