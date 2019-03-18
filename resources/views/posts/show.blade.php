@extends('layouts.master')
@section('title', $post->title)	

@section('content')
	<div class="col-sm-8 post-wrapper">		
		<h1 class="blog-post-title">{{ $post->title }}</h1>
		<p class="blog-post-meta">
			<em><a href="/">{{ $post->user->name }}</a> on
			{{ $post->created_at->toFormattedDateString() }}
			</em>
		</p>
	
		@can('update', $post) 
			<p>
				<a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
				<a href="/posts/{{ $post->id }}/create/files" class="btn btn-primary">Add File</a>
			</p>
		@endcan	

		@if(count($post->tags))
		 	<ul>
				@foreach($post->tags as $tag)
					<li><a href='/posts/tags/{{ $tag->name }}'>{{ $tag->name }}</a></li>
				@endforeach
			</ul>	
		@endif	
		<div class="content">{{ $post->body }}</div>
		
		@if($post->hasFile==1)
			<div class="gallery-block grid-gallery">			    
		        <div class="heading">
		            <h2>Gallery</h2>
		        </div>
		        <div class="row">
					@foreach($post->files as $file)
					<picture class="col-md-6 col-lg-4 item">
		                <a class="lightbox" href="/storage/posts/image/original/{{ $file['filename'] }}">
		                	<source media="(min-width: 1024px)" srcset="/storage/posts/image/original/{{ $file['filename'] }}">
							<source media="(min-width: 650px)" srcset="/storage/posts/image/small/{{ $file['filename'] }}">
							<source media="(min-width: 465px)" srcset="/storage/posts/image/small/{{ $file['filename'] }}">
		                    <img class="img-fluid image scale-on-hover" src="/storage/posts/image/small/{{ $file['filename'] }}">
		                </a>
	            	</picture> 						
					@endforeach	
				 	
			    </div>
			</div>
		@endif		

		<div class="comments">
			<ul class="list-group">
			@foreach($post->comments as $comment)
			<li class="list-group-item">
				<strong>
					{{ $comment->created_at->diffForHumans() }}
				</strong>
				{{ $comment->body }}
			</li>
			@endforeach	
			</ul>
		</div>

		@if(Auth::check())
			<div class="card">
				<div class="card-block">
					<form action="/posts/{{ $post->id }}/comments/" method="POST">				
						@csrf
						<div class="form_group">
							<textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Comment</button>
						</div>
					</form>
					@include('layouts.errors')
				</div>
			</div>
		@endif
	</div><!-- col-sm-8 blog-main -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
	<script>
		baguetteBox.run('.grid-gallery', { animation: 'slideIn'});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
	<link rel="stylesheet" href="/css/grid-gallery.css">

@endsection






