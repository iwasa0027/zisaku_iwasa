@extends('layouts.app')

@section('content')

@can('admin_only')
<h2>ユーザー情報</h2>

<form action="{{ route('user_crud_index') }}" method="GET">
@csrf
                                <input type="search" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                                <input type="submit" value="検索">
 </form>   

               
@if(count($users) > 0)
                    @foreach($users as $user)
<table class="table table-striped">

                <thead>
               
                    <tr>
                    <th>ID</th>
                        <th>名前</th>
                        <th>E-Mail</th>
                        <th>投稿数</th>
                    
                    </tr>
                </thead>
                
                <tbody>
                    <tr v-for="user in users">
                        <td v-text="user.id">{{$user->id}}</td>
                        <td v-text="user.name">{{Str::limit($user->name, 6, '…' )}}</td>
                        <td v-text="user.email">{{$user->email}}</td>
                        <td v-text="user.posts">{{$user->posts_count}}</td>
    
                        <td class="text-right">
                        <div class='row justify-content-around mt-3'>
                            <a href="{{route('adminuser.show',['adminuser'=>$user->id])}}">
                                    <button type='button' class='btn btn-warning'>ユーザー詳細</button>
                            </a></div> 
                      
                   
                    </tr>

                </tbody>
            </table>
            @endforeach
            
            @endif


            {{$users->links()}}

            @else
            <div class="text-center my-5">
    <p>ご不便をおかけして申し訳ございません。</p>
    <p class="lead">
    <a class="btn btn-primary" href="/" role="button">トップページへ戻る</a>
    </p>

            
            @endcan
            @endsection