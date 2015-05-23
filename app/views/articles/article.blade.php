<?php
	use Gregwar\Captcha\CaptchaBuilder;
?>	
@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | {{ $article->title }}
	</title>
@stop

@section('content')
	@if(Auth::check())
		<div class="well well_custom">	
			<div class="text-right">
				<a href="{{ URL::route('artikel-delete', $article->id) }}" class="btn btn-danger">Delete</a>	
			</div>
		</div>
	@endif
	<div class="well well_custom">
		<h2>{{ $article->title }}</h2>				
		<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal_download" >Download</a>	
		
		<hr>
		<div align="center">
			<h3><b>Abstract</b></h3>
		</div>		
		<p>{{ $article->abstract }}</p>
	</div>
	<div class="well well_custom">
		<h3><b>Additional Details</b></h3>
		<table class="table table-hover table-bordered table-striped" id="tab_details">
			<tbody>
				<tr>
					<td class="col-md-1">
					<b>Author</b>
					</td>
					<td class="col-md-3">
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
						<div style="display: none">{{ $countAuthor++ }}</div>
					@endforeach
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Year</b>
					</td>
					<td class="col-md-3">
					{{ $article->date }}
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Issue</b>
					</td>
					<td class="col-md-3">
					Volume {{$article->issue->first()->volume}}, Number {{$article->issue->first()->number}} - {{$article->issue->first()->month}} {{$article->issue->first()->year}}
					
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Keywords</b>
					</td>
					<td class="col-md-3">
					@foreach($article->keywords as $key)		
						@if(count($article->keywords) == 1)			
							{{ $key->kata }}
						@else
							@if($countKey == count($article->keywords))
								{{ $key->kata }}
							@else
								{{ $key->kata }},
							@endif
						@endif
						<div style="display: none">{{ $countKey++ }}</div>
					@endforeach
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Page Numbers</b>
					</td>
					<td class="col-md-3">
					0-200
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Hits</b>
					</td>
					<td class="col-md-3">
					{{ $article->hits }}
					</td>
				</tr>
				<tr>
					<td class="col-md-1">
					<b>Downloads</b>
					</td>
					<td class="col-md-3">
					{{ $article->downloads }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>	

	<div class="modal fade" id="modal_download" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">			
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>				
					<h4 class="modal-title">Download</h4>
				</div>
				<form id="form_download" method="post" action="{{ URL::route('artikel-download', $article->id) }}">
				<div class="modal-body">	
					<div class="row">	
						<div class="col-sm-6">			
							<div class="form-group{{ $errors->has('download_name') ? ' has-error' : '' }}">
								<label for="download_name">Name :</label>
								<input type="text" id="download_name" name="download_name" class="form-control" value="{{ Input::old('download_name') }}"></input>
								@if($errors->has('download_name'))
									<p>{{ $errors->first('download_name') }}</p>
								@endif
							</div>	
							<div class="form-group{{ $errors->has('download_email') ? ' has-error' : '' }}">
								<label for="download_email">Email :</label>
								<input type="text" id="download_email" name="download_email" class="form-control" value="{{ Input::old('download_email') }}"></input>
								@if($errors->has('download_email'))
									<p>{{ $errors->first('download_email') }}</p>
								@endif
							</div>	
							<div class="form-group{{ $errors->has('download_phone') ? ' has-error' : '' }}">
								<label for="download_phone">Phone :</label>
								<input type="text" id="download_phone" name="download_phone" class="form-control" value="{{ Input::old('download_phone') }}"></input>
								@if($errors->has('download_phone'))
									<p>{{ $errors->first('download_phone') }}</p>
								@endif
							</div>	
						</div>
						<div class="col-sm-6">	
							<div class="form-group{{ $errors->has('download_agency') ? ' has-error' : '' }}">
								<label for="download_agency">Agency :</label>
								<input type="text" id="download_agency" name="download_agency" class="form-control" value="{{ Input::old('download_agency') }}"></input>
								@if($errors->has('download_agency'))
									<p>{{ $errors->first('download_agency') }}</p>
								@endif
							</div>		
							<div class="form-group{{ $errors->has('download_captcha') ? ' has-error' : '' }}">	
								<?php
									$builder = new CaptchaBuilder;
									$builder->build();
								?>
								<label for="download_captcha">Security Check </label>		
								<div style="display:block;margin-bottom: 9px;">
									<img src="<?php echo $builder->inline(); ?>" />	
								</div>				
								<label>Type above word :</label> 								
								<input type="text" id="download_captcha" name="download_captcha" class="form-control"></input>
								<input name="download_key" type="hidden" value="{{$builder->getPhrase()}}">
								
								@if($errors->has('download_captcha'))
									<p>{{ $errors->first('download_captcha') }}</p>
								@endif
							</div>									
						</div>
					</div>
					{{ Form::token() }}					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>					
					<input type="submit" class="btn btn-primary" value="Download">					
				</div>
				</form>
			</div>
		</div>
	</div>
@stop

@section('javascript')
	@parent	
	@if(Session::has('modal'))
		<script type="text/javascript">
			$("#modal_download").modal('show');
		</script>
	@endif
@stop