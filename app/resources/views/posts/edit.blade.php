@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
<div>

@if($errors->any())
<div class='alert alert-danger'>
 <ul>
  @foreach($errors->all() as $message)
  <li>{{$message}}</li>
  @endforeach
 </ul>

</div>
@endif

<div class="container small" >

               
                 
<div class="card mb-4">

  <form action="/posts/{{$post->id}}" method="POST"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
    <label for="exampleFormControlInput1">タイトル</label>
      <input type="text" class="form-control" name="title" value="{{$post->title}}">
    </div>

    <div class="form-group">
    <input id="image_path" type="file" name="image_path" value="{{$post->image_path}}">
   
    </div>

    <div class="form-group">
   <label for="exampleFormControlInput1">タグ</label>
   <input type="text" name="tags" value="{{old('tags')}}">
 </div>



    <div class="form-group">
    <label for="exampleFormControlTextarea1">本文</label>
      <textarea class="form-control"rows="5" name="feelings">{{$post->feelings}}</textarea>
    </div>
    
    <a href="{{route('mypages.index')}}">
    <input type="submit" class="btn btn-primary" value="更新"/>
       </a>
       </form>
  <form action="/posts/{{$post->id}}" method="POST">
    @method('DELETE')
    @csrf
    <input type="submit" class="btn btn-danger mt-3" onclick="return confirm('この投稿を削除してもよろしいですか。')" value="削除"/>
  </form>

</div>
@endsection
