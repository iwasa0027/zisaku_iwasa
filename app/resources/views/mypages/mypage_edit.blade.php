@extends('layouts.app')

@section('title', 'ユーザー情報編集')

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

<form action="{{ route('mypages.update', $auth->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="password" value="{{$mypage->password}}">


    <div class="form-group">
    <label for="exampleFormControlInput1">アイコン画像</label>
    <input id="image" class="form-control" type="file" name="image" value="{{$mypage->image}}">
   
    </div>

    <div class="form-group">
    <label for="exampleFormControlInput1">名前</label>
      <input type="text"  name="name" value="{{$mypage->name}}">
    </div>


   

   <div class="form-group">
   <label for="exampleFormControlInput1">メールアドレス</label>
   <input type="text" name="email" value="{{$mypage->email}}">
   </div>


    <div class="form-group">
    <label for="exampleFormControlTextarea1">プロフィール</label>
      <textarea class="form-control"rows="5" name="profile">{{$mypage->profile}}</textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="更新"/>
  </form>
</div>
</div>
  

</div>  


@endsection
