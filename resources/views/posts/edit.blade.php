@extends('layouts.master')

@section('title', $post->title)	


@section('content')
	
	<div class="col-lg-5" style="background: #f7f7f7; padding: 10px">
		<h1 class="title">Edit Post</h1>		
		<form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
			@method('PATCH')	
			@csrf
			<div class="form-group">
				<label class="label" for="title">Title</label>
				<input type="text" class="form-control input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" placeholder="Title" value="{{ $post->title }}" required>
			</div>
			<div class="form-group">
				<label class="label" for="body">Body</label>
				<textarea name="body" class="form-control textarea {{ $errors->has('title') ? 'is-danger' : '' }}" placeholder="Body text" required>{{ $post->body }}</textarea>				
			</div>			

			<div class="form-group">				
				<div class="control">
					<button type="submit" name="update" class="btn btn-primary">Update Post</button>
				</div>				
			</div>			
		</form>

		<form method="POST" action="/posts/{{ $post->id }}">
			@method('DELETE')	
			@csrf
			<div class="form-group">				
				<div class="control">
					<button type="submit" name="delete" class="btn is-link">Delete Post</button>
				</div>				
			</div>
		</form>

		@include('layouts.errors')

	</div>

@endsection