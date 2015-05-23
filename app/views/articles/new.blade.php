@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | New Artikel
	</title>
@stop

@section('content')
	{{ Form::open(array('route'=>'artikel-store','method'=>'POST', 'files'=>true)) }}	
		<div class="well well_custom">	
			<h1><b>New Artikel</b></h1>		
			<div class="form-group{{ ($errors->has('title')) ? ' has-error' : ''}}">
				<label for="title">Title: </label>
				<input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}"></input>
				@if($errors->has('title'))
					<p>{{ $errors->first('title') }}</p>
				@endif
			</div>

			<div class="form-group{{ ($errors->has('abstract')) ? ' has-error' : ''}}">
				<label for="abstract">Abstract: </label>
				<textarea class="form-control" name="abstract" id="abstract" value="{{ Input::old('abstract') }}"></textarea>
				@if($errors->has('abstract'))
					<p>{{ $errors->first('abstract') }}</p>
				@endif
			</div>		

			<div class="form-group{{ ($errors->has('file')) ? ' has-error' : ''}}">
				<label for="file">File: </label>
				<input name="file" id="file" type="file" class="file btn-success" accept=".pdf"></input>
				@if($errors->has('file'))
					<p>{{ $errors->first('file') }}</p>
				@endif
			</div>		
			<div class="row">
				<div class="col-sm-3 form-group{{ ($errors->has('datepicker')) ? ' has-error' : ''}}">
					<label for="datepicker">Date: </label>
					<input type="text" id="datepicker" name="datepicker" class="form-control"></input>
					@if($errors->has('datepicker'))
						<p>{{ $errors->first('datepicker') }}</p>
					@endif
				</div>			
			</div>		
			<div class="row">
				<div class="col-sm-6 form-group{{ ($errors->has('keywords')) ? ' has-error' : ''}}">
					<label for="keywords">Keywords: </label>
					<input type="text" id="keywords" name="keywords" class="form-control" placeholder="Separate with coma ','"></input>
					@if($errors->has('keywords'))
						<p>{{ $errors->first('keywords') }}</p>
					@endif
				</div>			
			</div>	
		</div>	
		<div class="well well_custom">				
			<label>Author:</label>
			<table class="table table-bordered" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							#
						</th>
						<th class="text-center">
							Name
						</th>
						<th class="text-center">
							Email
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td class="{{ ($errors->has('author.0')) ? 'has-error' : ''}}">
						<input type="text" placeholder='Name' class="form-control" name='author[]' value="{{ Input::old('author.0') }}"></input>			
						@if($errors->has('author.0'))
							<p>{{ $errors->first('author.0') }}</p>
						@endif		
						</td>
						<td class="{{ ($errors->has('email.0')) ? 'has-error' : ''}}">
						<input type="text" placeholder='Email' class="form-control" name='email[]'></input>						
						@if($errors->has('email.0'))
							<p>{{ $errors->first('email.0') }}</p>
						@endif		
						</td>
					</tr>
                    <tr id='addr1'></tr>
				</tbody>
			</table>
			<div class="clearfix">
				<a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
			</div>	
		</div>

		<div class="well well_custom">	
			<label>Issue: </label>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group{{ ($errors->has('issue')) ? ' has-error' : ''}}">
						<select class="form-control" name="issue" id="issue">
							@foreach($issue as $key)
								<option value="{{$key->id}}">Volume {{$key->volume}}, Number {{$key->number}} - {{$key->month}} {{$key->year}}</option>
							@endforeach
						</select>
						@if($errors->has('issue'))
							<p>{{ $errors->first('issue') }}</p>
						@endif
					</div>	
				</div>
			</div>
		</div>

		<div class="form-group">			
			<input type="submit" value="Simpan Artikel" class="btn btn-primary"></input>
		</div>		
	{{ Form::close() }}	
@stop