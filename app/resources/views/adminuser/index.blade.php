@extends('layouts.app')

@section('content')


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
                        <th>ユーザー詳細</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr v-for="user in users">
                        <td v-text="user.id">{{$user->id}}</td>
                        <td v-text="user.name">{{$user->name}}</td>
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




            

            @endsection