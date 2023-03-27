 @extends('layouts.app')

@section('title', '新規投稿')

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



 <!-- <img src="{{ asset('storage/images/IMG_3894.JPG') }}" alt="">画像確認  -->
 <h3 class="fw-bolder mb-1">新規投稿</h3>
 <div class="container small" >

               
                 
                   <div class="card mb-4">
<form method="POST" action="{{route('posts.store')}}"  enctype="multipart/form-data">
  @csrf
  


    <div class="form-group">
    <h6><label for="exampleFormControlInput1">タイトル</label></h6>
      <input type="text" class="form-control" name="title" value="{{old('title')}}">
    </div>

    <div class="form-group">
    <h6><label for="exampleFormControlInput1">写真(1枚選択してください)</label></h6>
    <input id="image_path" type="file" name="image_path" value="{{old('image_path')}}" multiple="multiple">
    </div>

    <div class="form-group">
   <h6><label for="exampleFormControlInput1">タグ(半角#を先頭につけてください)</label></h6>
   <label for="exampleFormControlInput1">※必須項目ではありません。</label><br>
   <input type="text" class="form-control" name="tags" value="{{old('tags')}}">
 </div>

    <div class="form-group">
    <h6><label for="exampleFormControlTextarea1">本文(500字以下で入力してください。)</label></h6>
      <textarea class="form-control"rows="5" onkeyup="ShowLength(value);" name="feelings">{{old('feelings')}}</textarea>
      <h6 id="inputlength">0文字</h6>

    </div>
    <input type="submit" class="btn btn-primary" value="投稿"/>
    <a href="{{ route('home')}}">
            <button type='button' class='btn btn-primary'>ホームに戻る</button></a>
  
  </form>
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