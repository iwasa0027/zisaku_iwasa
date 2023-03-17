@extends('layouts.app')

@section('title', $post->title)

@section('content')
<form action="/morepost" method="POST"  enctype="multipart/form-data">
    <div class="card my-3">
      <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p class="card-text">{{$post->tags}}</p>
        <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
        <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small>
    

       
        <p class="card-text">{{$post->image_path}}</p>
        <img src="{{ asset($post->image_path) }}">
        <p class="card-text">{{$post->feelings}}</p>
      </div>
    </div>

    <div class='row justify-content-around mt-3'>
       <a href="{{ url('home')}}">
            <button type='button' class='btn btn-primary'>ホームへ</button>
       </a></div> 
@endsection