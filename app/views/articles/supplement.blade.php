@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | Online Supplements
	</title>
@stop

@section('content')
	<div class="well well_custom home-content">
		<h1>Online Supplements</h1>
		@foreach($issue as $k_issue)	
			<div style="margin-top: 30px;">
				<h1>{{ $k_issue->month }} {{ $k_issue->year }}</h1>
				@foreach($k_issue->articles as $article)									
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
		@endforeach	
	</div>
@stop