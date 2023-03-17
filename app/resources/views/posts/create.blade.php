 @extends('layouts.app')

@section('title', '新規投稿')

@section('content')
<div>

 <!-- <img src="{{ asset('storage/images/IMG_3894.JPG') }}" alt="">画像確認  -->
<form method="POST" action="{{route('posts.store')}}"  enctype="multipart/form-data">
  @csrf
    <div class="form-group">
    <label for="exampleFormControlInput1">タイトル</label>
      <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
    <input id="image_path" type="file" name="image_path">
    <button type="submit">
       アップロード
    </button>
    </div>

    <div class="form-group">
   <label for="exampleFormControlInput1">タグ</label>
   <input type="text" name="tags" value="{{old('tags')}}">
 </div>

    <div class="form-group">
    <label for="exampleFormControlTextarea1">本文</label>
      <textarea class="form-control"rows="5" name="feelings"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="投稿"/>
  </form>
</div>
@endsection 