@extends('layouts.app')

@section('title', 'ユーザー情報')

@section('content')

<div>
<form action="{{route('mypages.edit',auth()->user()->id)}}" method="POST" >

    @csrf
    <div class="form-group">
    <label for="exampleFormControlInput1">プロフィール</label>
      <input type="text" class="form-control" name="profile" value="{{$mypage->profile}}">
    </div>


<input type="submit" class="btn btn-primary" value="更新"/>
</form>
@endsection
