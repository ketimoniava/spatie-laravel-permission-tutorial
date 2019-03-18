@extends('layouts.master')
@section('title')
	Latest posts
@endsection

@section('content')
	<div class="col-sm-8 blog-main">
		@if(Auth::check())
			<div class="btns">
				<a href="/posts/create" class="btn btn-primary">Add Post</a>
			</div>
		@endif
		@foreach($posts as $post)
		@include('posts.post')
		@endforeach
	</div>
@endsection

@section('footer')
	<script src='/js/file.js'></script>
@endsection