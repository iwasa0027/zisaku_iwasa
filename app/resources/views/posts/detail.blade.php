@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="card my-3">
      <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p>@foreach($post->tags as $tag)
          <a href=""> #{{ $tag->tag_name }}</a>
           @endforeach</p>
        <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
        <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small>
        <a href="/posts/{{$post->id}}/edit">編集</a>

        <img src="{{ asset($post->image_path) }}">
        <p class="card-text">{{$post->feelings}}</p>
      </div>
    </div>

    <div class='row justify-content-around mt-3'>
       <a href="{{ url('home')}}">
            <button type='button' class='btn btn-primary'>ホームへ</button>
       </a></div> 
@endsection
