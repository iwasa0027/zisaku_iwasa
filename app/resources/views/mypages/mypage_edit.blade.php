@extends('layouts.app')

@section('title', 'ユーザー情報編集')

@section('content')

<h3 class="fw-bolder mb-1">ユーザー情報編集</h3>
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

<form action="{{ route('mypages.update', $auth->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="password" value="{{$mypage->password}}">


    <div class="form-group">
    <h6><label for="exampleFormControlInput1" >アイコン画像</label></h6>
    <input id="image" class="form-control" type="file" name="image" value="{{$mypage->image}}">
 
    </div>

    <div class="form-group">
    <h6><label for="exampleFormControlInput1">名前</label></h6>
      <input type="text"  name="name" value="{{$mypage->name}}">
    </div>


   

   <div class="form-group">
   <h6><label for="exampleFormControlInput1">メールアドレス</label></h6>
   <input type="text" name="email" value="{{$mypage->email}}">
   </div>


    <div class="form-group">
    <h6><label for="exampleFormControlTextarea1">プロフィール(300文字以下で入力してください。)</label></h6>
      <textarea class="form-control"rows="5"  onkeyup="ShowLength(value);" name="profile">{{$mypage->profile}}</textarea>
      <h6 id="inputlength">{{mb_strlen($mypage->profile)}}文字</h6>
    </div>
    <input type="submit" class="btn btn-primary" value="更新"/>

    <a href="{{ route('mypages.index')}}">
            <button type='button' class='btn btn-primary'>マイページに戻る</button></a>
  </form>


</div>
</div>
  

</div>  
<style>
body{
    background-color: #eb8686;
}
</style>

<script>
  function ShowLength( str ) {
   document.getElementById("inputlength").innerHTML = str.length + "文字";

   if( str.length>='301'){
    document.getElementById("inputlength").style.color = "red";
   }else if( str.length>='200'){
    document.getElementById("inputlength").style.color = "yellow";
   }
}
</script>

@endsection
