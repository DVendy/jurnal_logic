@extends('layout.master')

@section('head')
	@parent
	<title>Home Page</title>
	
@stop

@section('content')
	<div class="well well_custom home-content">
		<div class="row">
			<div class="col-md-8">
				<h1>Bulletin Board</h1>
				&nbsp
				&nbsp
				&nbsp
				<h1>LOGIC Awards</h1>
				<p>2013 Paper of the Year: “Impact of Wikipedia on Market Information Environment: Evidence on Management Disclosure and Investor Reaction,” <strong>Sean Xin Xu</strong>, Tsinghua University, and <strong>Xiaoquan (Michael) Zheng</strong>, Hong Kong Univerfsity of Science and Technology (Volume 37, Issue 4, December 2013)</p>
				<p>2013 Reviewers of the Year: <strong>Peter Gray</strong>, University of Virginia, and <strong>Brad Greenwood</strong>, Temple University</p>
				<p>2013 Outstanding Associate Editors: <strong>Bin Gu</strong>, Arizona State University, and <strong>Likoebe Maruping</strong>, Georgia State University</p>
			</div>
			<div class="col-md-4 text-right home-poster">
				<img src="{{ URL::asset('images/journal.jpg')}}" />	
			</div>
		</div>
	</div>
@stop