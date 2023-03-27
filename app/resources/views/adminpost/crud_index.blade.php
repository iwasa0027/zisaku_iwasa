@extends('layouts.app')

@section('content')

@can('admin_only')
<h2>投稿情報</h2>
   

@if(count($posts) > 0)
                    @foreach($posts as $post)
<table class="table table-striped">

                <thead>
               
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>投稿日</th>
                        <th>編集日</th>
                        <th>タイトル</th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    <tr v-for="user in posts">
                        <td v-text="post.id">{{$post->id}}</td>
                        <td v-text="post.name">{{Str::limit($post->user->name, 6, '…' )}}</td> 
                        <td v-text="post.title">{{$post->created_at}}</td>
                        <td v-text="post.title">{{$post->updated_at}}</td>
                        <td v-text="post.title">{{Str::limit($post->title, 10, '…' )}}</td>
                        
                        <!-- {{route('adminpost.show',$post->id)}} -->

    
                        <td class="text-right">
                  
                        <div class='row justify-content-around mt-3'>
                            <a href="{{route('adminpost.show',['adminpost'=>$post->id])}}">
                                    <button type='button' class='btn btn-warning'>投稿詳細</button>
                            </a></div> 
                        </td>
                    
                    </tr>

                </tbody>
            </table>
            @endforeach
         {{$posts->appends(request()->query())->links()}}
            @endif

            <div class="text-center my-5">
            <a href="{{ route('adminpost.index')}}">
            <button type='button' class='btn btn-primary'>ホームに戻る</button></a>


            @else
            <div class="text-center my-5">
    <p>ご不便をおかけして申し訳ございません。</p>
    <p class="lead">
    <a class="btn btn-primary" href="/" role="button">トップページへ戻る</a>
    </p>



            @endcan

            @endsection