@extends('layouts.app')

@section('content')


<h2>投稿情報</h2>
   



 <form action="{{ route('crud_index') }}" method="GET">
    @csrf
                                <input type="search" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                                <input type="submit" value="検索">
                            </form>



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
                        <td v-text="post.name">{{$post->user->name}}</td> 
                        <td v-text="post.title">{{$post->created_at}}</td>
                        <td v-text="post.title">{{$post->updated_at}}</td>
                        <td v-text="post.title">{{$post->title}}</td>
                        
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
         {{$posts->links()}}
            @endif

       



            

            @endsection