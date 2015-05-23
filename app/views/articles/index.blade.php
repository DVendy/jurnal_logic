@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | Artikel
	</title>
@stop

@section('content')

	@if(Auth::check())
		<div class="clearfix">
			<a href="{{ URL::route('artikel-new') }}" class="btn btn-success pull-left">New Artikel</a>
		</div>
		<hr>
	@endif
	<div class="panel panel-danger">
		<div class="panel-heading">
			<div class="clearfix">
				<h3 class="panel-title pull-left">Artikel</h3>			
			</div>						
		</div>		
		<div class="list-group">		
			@foreach($articles as $article)									
				<a href="{{ URL::route('artikel-show', $article->id) }}" class="list-group-item">
					<h4>{{ $article->title }}</h4>
					@foreach($article->authors as $author)	
						<h6>Oleh: {{ $author->name }}</h6>							
					@endforeach
				</a>
			@endforeach		
		</div>
	</div>
@stop