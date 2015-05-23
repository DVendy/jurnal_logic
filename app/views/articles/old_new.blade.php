@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | New Artikel
	</title>
@stop

@section('content')
	<div class="well">	
		<h1><b>New Artikel</b></h1>
		{{ Form::open(array('route'=>'artikel-store','method'=>'POST', 'files'=>true)) }}	
			<div class="form-group{{ ($errors->has('title')) ? ' has-error' : ''}}">
				<label for="title">Judul: </label>
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

			<div class="form-group{{ ($errors->has('datepicker')) ? ' has-error' : ''}}">
				<label for="datepicker">Date: </label>
				<input type="text" id="datepicker" name="datepicker"></input>
				@if($errors->has('datepicker'))
					<p>{{ $errors->first('datepicker') }}</p>
				@endif
			</div>			
		</div>	
		<div class="well">		
			<div class="form-group{{ ($errors->has('author')) ? ' has-error' : ''}}">
				<label for="author">Penulis: </label>
				<input type="text" class="form-control" name="author" id="author" value="{{ Input::old('author') }}"></input>
				@if($errors->has('author'))
					<p>{{ $errors->first('author') }}</p>
				@endif
			</div>

			<div class="form-group{{ ($errors->has('email')) ? ' has-error' : ''}}">
				<label for="email">Email: </label>
				<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email') }}"></input>
				@if($errors->has('email'))
					<p>{{ $errors->first('email') }}</p>
				@endif
			</div>	

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
						<td class="{{ ($errors->has('author')) ? 'has-error' : ''}}">						
						<input type="text" placeholder='Name' class="form-control" name="author" id="author" value="{{ Input::old('author') }}"></input>
						@if($errors->has('author'))
							<p>{{ $errors->first('author') }}</p>
						@endif
						</td>
						<td class="{{ ($errors->has('email')) ? 'has-error' : ''}}">							
						<input type="text" placeholder='Email' class="form-control" name="email" id="email" value="{{ Input::old('email') }}"></input>
						@if($errors->has('email'))
							<p>{{ $errors->first('email') }}</p>
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
		{{ Form::token() }}
		<div class="form-group">			
			<input type="submit" value="Simpan Artikel" class="btn btn-primary"></input>
		</div>		
		{{ Form::close() }}	
@stop