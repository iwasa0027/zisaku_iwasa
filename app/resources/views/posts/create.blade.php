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
 <div class="container small" >

               
                 
                   <div class="card mb-4">
<form method="POST" action="{{route('posts.store')}}"  enctype="multipart/form-data">
  @csrf
  
    <div class="form-group">
    <label for="exampleFormControlInput1">タイトル</label>
      <input type="text" class="form-control" name="title" value="{{old('title')}}">
    </div>

    <div class="form-group">
    <label for="exampleFormControlInput1">写真</label>
    <input id="image_path" type="file" name="image_path" value="{{old('image_path')}}" multiple="multiple">
    
    
    </div>

    <div class="form-group">
   <label for="exampleFormControlInput1">タグ</label>
   <input type="text" name="tags" value="{{old('tags')}}">
 </div>

    <div class="form-group">
    <label for="exampleFormControlTextarea1">本文</label>
      <textarea class="form-control"rows="5" name="feelings">{{old('feelings')}}</textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="投稿"/>
  </form>
                   </div>
</div>


@endsection 