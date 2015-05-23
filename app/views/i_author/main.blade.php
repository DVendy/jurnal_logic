@extends('layout.master')

@section('head')
@parent
<title>Instructions for Authors</title>
<style type="text/css">
	br{
		margin: 5px 0px;
	}
</style>
@stop

@section('content')
<div class="well well_custom home-content">
	<div class="row">
		<div class="col-md-8">
			<h1>Instructions for Authors</h1>
			&nbsp
			&nbsp
			&nbsp
			<p>
				<a href="{{ URL::route('i-auth-mission') }}">Mission and Obtaining Feedback before Submission</a>
				<br>
				<a href="{{ URL::route('i-auth-review') }}">Review Basics</a>
				<br>
				<a href="{{ URL::route('i-auth-categories') }}">Manuscript Categories and Category Lengths</a>
				<br>
				<a href="{{ URL::route('i-auth-not-published') }}">Types of Papers MISQ Does Not Publish</a>
				<br>
				<a href="#">Manuscript Guidelines</a>
				<br>
				<a href="#">Blinding Your Manuscript</a>
				<br>
				<a href="#">Review Process</a>
				<br>
				<a href="#">Editor and Reviewer Nominations by Authors</a>
				<br>
				<a href="#">Conflicts of Interest</a>
				<br>
				<a href="#">Provenance Declaration & Commitment to Service</a>
				<br>
				<a href="#">Compliance with AIS Code of Research Conduct</a>
				<br>
				<a href="#">Sample Cover Letter</a>
				<br>
				<a href="#">Copyright Information</a>
				<br>
				<a href="#">Author Checklist</a>
				<br>
				<a href="#">Accepted Papers</a>
			</p>
		</div>
	</div>
</div>
@stop