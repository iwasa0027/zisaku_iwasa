@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
<h3 class="fw-bolder mb-1">投稿編集</h3>
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
    <h6><label for="exampleFormControlInput1">タイトル</label></h6>
      <input type="text" class="form-control" name="title" value="{{$post->title}}">
    </div>

    <div class="form-group">
    <h6><label for="exampleFormControlInput1">写真</label></h6>
    <input id="image_path" type="file" name="image_path" value="{{ asset($post->image_path) }}">
   
    </div>

    <div class="form-group">
    <h6><label for="exampleFormControlInput1">タグ</label></h6>
   <input type="text" class="form-control" name="tags" value="@foreach($post->tags as $tag) #{{ $tag->tag_name }} @endforeach">
 </div>



    <div class="form-group">
    <h6><label for="exampleFormControlTextarea1">本文</label></h6>
      <textarea class="form-control"rows="5" onkeyup="ShowLength(value);" name="feelings">{{$post->feelings}}</textarea>
      <h6 id="inputlength">{{mb_strlen($post->feelings)}}文字</h6>
    </div>
    
    
    <div class="form-group">
    <a href="{{route('mypages.index')}}">
    <input type="submit" class="btn btn-primary" value="更新"/>
       </a>
       </form>

       <a href="{{ route('mypages.index')}}">
            <button type='button' class='btn btn-primary'>戻る</button></a>

  <form action="/posts/{{$post->id}}" method="POST">
    @method('DELETE')
    @csrf
    <input type="submit" class="btn btn-danger mt-3" onclick="return confirm('この投稿を削除してもよろしいですか。')" value="削除"/>
  </form>
</div>
 
</div>
</div>

<script>
  function ShowLength( str ) {
   document.getElementById("inputlength").innerHTML = str.length + "文字";

   if( str.length>='501'){
    document.getElementById("inputlength").style.color = "red";
   }else if( str.length>='400'){
    document.getElementById("inputlength").style.color = "yellow";
   }
}
</script>
@endsection
