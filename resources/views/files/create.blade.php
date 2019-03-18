@extends('layouts.master')

@section('content')
	<div class="col-lg-5" style="background: #f7f7f7; padding: 10px">
		<h1>upload file page</h1>		
		<form method="POST" action="/posts/{{ $post->id }}/files" enctype="multipart/form-data">
		  <legend>Upload file</legend>
		  	@csrf
		    <div class="form-group">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="validatedCustomFile" name="upload-files[]" multiple>
					<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
					<div class="invalid-feedback">Example invalid custom file feedback</div>
				</div>
			</div>
			<div class="form-group">				
				<div class="control">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
			@include('layouts.errors')
		</form>
	</div>
@endsection