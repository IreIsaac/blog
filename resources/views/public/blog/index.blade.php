@extends('public.layout.main')

@section('content')
	<div class="container" style="margin-top: 20px;">
		<div class="articles">
			@foreach($posts as $post)
				<article>
					<h2>{{ $post->title }} <small class="date">{{ $post->created_at->toDateString() }}</small></h2>
					<p class="author">
						<a href="{{ route('blog.index', ['by' => $post->author->username]) }}">By: {{ $post->author->name }}</a>

						@foreach($post->tags->pluck('name')->toArray() as $tagName)
							 <span class="badge-notice">
							 	<a href="{{ route('blog.index', ['tag' => $tagName]) }}">{{$tagName}}</a>
							 </span>
						@endforeach
					</p>
					

					{!! str_limit(strip_tags($post->html), 250) !!}
						<a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="read-more">Read More <span>&rsaquo;</span></a>
				</article>
			@endforeach
		</div>

		<div class="articles__filters">
			<h3>Tags</h3>
			<ul>
				@foreach($tags as $tag)
					<li><a href="{{ route('blog.index', [ 'tag' => $tag->name ]) }}">{{ $tag->name }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
		@include('public.partials.pagination', ['model' => $posts])
@endsection