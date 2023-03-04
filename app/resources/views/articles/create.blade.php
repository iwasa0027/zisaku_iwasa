



 @extends('layouts.app')

@section('title', '新規投稿')

@section('content')
<div>
<form method="POST" action="/articles">
  @csrf
  <form>
    <div class="form-group">
    <label for="exampleFormControlInput1">タイトル</label>
      <input type="text" class="form-control" name="title">
    </div>
<!-- 
    <div class="form-group">
    <img id="preview">
    <input type="file" name="test" onchange="previewFile(this);">

    <script>
  function previewFile(hoge){
    var fileData = new FileReader();
    fileData.onload = (function() {
      //id属性が付与されているimgタグのsrc属性に、fileReaderで取得した値の結果を入力することで
      //プレビュー表示している
      document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(hoge.files[0]);
  }
  </script>
    </div> -->

    <div class="form-group">
    <label for="exampleFormControlTextarea1">本文</label>
      <textarea class="form-control"rows="5" name="feelings"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="投稿"/>
  </form>
</div>
@endsection 