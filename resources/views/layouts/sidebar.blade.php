@if(count($archives)>0 || count($tags)>0)
<div class="col-sm">
	<div class="wrapper">
		@if(count($archives)>0)

		<h4>Archives</h4>
	    <!-- Sidebar -->
	    <nav id="sidebar">
	        <ul>
				@foreach($archives as $stats)
				<li>
					<a href="/?month={{ $stats['month'] }}&year={{ $stats['year']}}">{{ $stats['month'].' '.$stats['year'] }}</a>
				</li>
				@endforeach
			</ul>
	    </nav>

	    @endif

	    <!-- Page Content -->

	    @if(count($tags)>0)
	    <h4>Tags</h4>
		<nav class="col-sm-3">	    
		    <ul>
		     @foreach($tags as $tag)
			<li>
				<a href="/posts/tags/{{ $tag }}">{{ 
					$tag
				}}</a>
			</li>
			@endforeach
		    </ul>
		</nav>

		@endif
	</div>  <!-- wrapper -->

</div> <!-- col-sm -->


@endif









