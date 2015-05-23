<!DOCTYPE html>
<html lang="en">
<head>
	@section('head')
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
	@show
</head>
<body>		
	<nav class="navbar navbar-inverse navbar-fixed-top"> 			
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{ URL::route('home') }}" class="navbar-brand">Jurnal Logic</a>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::route('home') }}">Home</a></li>
					<li><a href="{{ URL::route('artikel-home') }}">Artikel</a></li>
					<li><a href="{{ URL::route('archive-home') }}">Journal Archive</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if(!Auth::check())
						<li><a href="{{ URL::route('getCreate') }}">Register</a></li>
						<li><a href="{{ URL::route('getLogin') }}">Login</a></li>
					@else
						<li><a href="{{ URL::route('getLogout') }}">Logout</a></li>
					@endif
				</ul>
			</div>			
		</div>
	</nav>		

	<div class="container-fluid">		
		@yield('content')
	</div>	

	<div class="custom_info">
		@if(Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>
		@elseif (Session::has('fail'))
			<div class="alert alert-danger">{{ Session::get('fail') }}</div>
		@endif
	</div>

	<footer class="footer">
		<div class="container-fluid">
			<p class="text-muted">Place sticky footer content here.</p>
		</div>
    </footer>

	@section('javascript')		
		<script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="{{ URL::asset('js/app.js') }}" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
	@show
	
</body>
</html>
