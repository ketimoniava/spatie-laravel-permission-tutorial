<div class="post-wrapper">
 	@if(count($post->files))
		<div class="image-wrapper">
			<picture>
				<source media="(min-width: 650px)" srcset="storage/posts/image/small/{{ $post->files->last()['filename'] }}">
				<source media="(min-width: 465px)" srcset="storage/posts/image/small/{{ $post->files->last()['filename'] }}">
				<img src="storage/posts/image/original/{{ $post->files->last()['filename'] }}" alt="" style="width:100%;">
			</picture>
		</div><!-- image-wrapper -->
	@endif
	<div class="text-wrapper">
		<h2 class="h2 blog-post-title">
			<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
		</h2>
		<p class="blog-post-meta">
			{{ $post->user->name }} on
			{{ $post->created_at->toFormattedDateString() }}	
		</p>
		<p>{{ substr($post->body, 0, strrpos(substr($post->body, 0, 300), " ")) }} ... </p>	
	</div><!-- text-wrapper -->
</div><!-- post-wrapper -->




