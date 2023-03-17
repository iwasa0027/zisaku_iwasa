@extends('layouts.app')
@section('content')
<form action="{{ route('/bookmarks') }}" method="post">
<h1 class="page-heading">ブックマークした記事</h1>
@include('posts.posts')

{{ $posts->links() }}
@endsection()