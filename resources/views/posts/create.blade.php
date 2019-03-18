@extends('layouts.master')

@section('content')
<div class="col-lg-5" style="background: #f7f7f7; padding: 10px">
	<h1>Post page</h1>
	
	<form method="POST" action="/posts">
	  <legend>Create a post</legend>
	  	@csrf
			<div class="form-group">
				<label class="label" for="title">Title</label>
				<input type="text" class="form-control input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" placeholder="Title" value="" required>
			</div>

		  	<div class="form-group">
				<label class="label" for="body">Body</label>
				<textarea name="body" class="form-control textarea {{ $errors->has('title') ? 'is-danger' : '' }}" placeholder="Body text" required></textarea>				
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>

		@include('layouts.errors')

	</form>

</div>




	

@endsection