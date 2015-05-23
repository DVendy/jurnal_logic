@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | New Issue
	</title>
@stop

@section('content')
	{{ Form::open(array('route'=>'artikel-store-issue','method'=>'POST', 'files'=>true)) }}	
		<div class="well well_custom">	
			<h1><b>New Issue</b></h1>		
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group{{ ($errors->has('year')) ? ' has-error' : ''}}">
						<label for="year">Year: </label>
						<input class="form-control" type="text" name="year" id="year" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder='eg:1999, 2000, 2010, ...'></input>
						@if($errors->has('year'))
							<p>{{ $errors->first('year') }}</p>
						@endif
					</div>	
				</div>
				<div class="col-sm-3">
					<div class="form-group{{ ($errors->has('volume')) ? ' has-error' : ''}}">
						<label for="volume">Volume: </label>
						<input class="form-control" type="text" name="volume" id="volume" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder='eg:1, 2, 3, ...'></input>
						@if($errors->has('volume'))
							<p>{{ $errors->first('volume') }}</p>
						@endif
					</div>	
				</div>
				<div class="col-sm-3">
					<div class="form-group{{ ($errors->has('number')) ? ' has-error' : ''}}">
						<label for="number">Number: </label>
						<input class="form-control" type="text" name="number" id="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder='eg:1, 2, 3, ...'></input>
						@if($errors->has('number'))
							<p>{{ $errors->first('number') }}</p>
						@endif
					</div>	
				</div>
				<div class="col-sm-3">
					<div class="form-group{{ ($errors->has('month')) ? ' has-error' : ''}}">
						<label for="month">Month: </label>
						<select class="form-control" name="month" id="month">
							<option>January</option>
							<option>February</option>
							<option>March</option>
							<option>April</option>
							<option>May</option>
							<option>June</option>
							<option>July</option>
							<option>August</option>
							<option>September</option>
							<option>October</option>
							<option>November</option>
							<option>December</option>	
						</select>
						@if($errors->has('month'))
							<p>{{ $errors->first('month') }}</p>
						@endif
					</div>	
				</div>
			</div>
		</div>

		<div class="form-group">			
			<input type="submit" value="Save Issue" class="btn btn-primary"></input>
		</div>		
	{{ Form::close() }}	
@stop