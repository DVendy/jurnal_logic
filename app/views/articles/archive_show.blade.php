@extends('layout.master')

@section('head')
	@parent
	<title>
		Volume {{$issue->volume}}, Number {{$issue->number}} - {{$issue->month}} {{$issue->year}}
	</title>
@stop

@section('content')

	<div class="well well_custom">
		<h1>Volume {{$issue->volume}}, Number {{$issue->number}} - {{$issue->month}} {{$issue->year}}</h1>
		@foreach($articles as $article)									
			<a href="{{ URL::route('artikel-show', $article->id) }}" class="list-group-item">
				<h4>{{ $article->title }}</h4>
				<?php
					$countAuthor = 1;
				?>
				@foreach($article->authors as $author)		

					@if(count($article->authors) == 1)			
						{{ $author->name }}
					@else
						@if($countAuthor == count($article->authors))
							and {{ $author->name }}
						@else
							@if($countAuthor == count($article->authors)-1)
								{{ $author->name }}
							@else
								{{ $author->name }},
							@endif
						@endif
					@endif
					<?php
						$countAuthor++;
					?>
				@endforeach
			</a>
		@endforeach		
	</div>
@stop