<!DOCTYPE html>
<html lang="en">
<head>
	@section('head')
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home.css') }}">
	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
	@show
</head>
<body>		
	<div class="batas-atas"></div>
	<div class="bg">
		<div class="container">	
			<div class="row">
				<div class="col-md-4">
					<a href="{{ URL::route('home') }}">
						<img src="{{ URL::asset('images/logo.png')}}" style="width: 100%;" />	
					</a>
				</div>
				
				<div class="col-md-5 col-md-offset-3">
					<ul class="nav nav-pills nav-custom plus-atas">
						<li role="presentation" class="{{$nav == 'home' || null ? 'active' : ''}}"><a href="{{ URL::route('home') }}">Home</a></li>
						<li role="presentation" class="{{$nav == 'current' || null ? 'active' : ''}}"><a href="{{ URL::route('artikel-current') }}">Current Issue</a></li>
						<li role="presentation"><a href="#">Contact</a></li>
						@if(!Auth::check())
						<li role="presentation" class="dropdown {{$nav == 'account' || null ? 'active' : ''}}">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
						      Account <span class="caret"></span>
						    </a>
						    <ul class="dropdown-menu" role="menu">
						    	<li role="presentation"><a href="{{ URL::route('getLogin') }}">Login</a></li>
								<li role="presentation"><a href="{{ URL::route('getCreate') }}">Register</a></li>
						    </ul>
						</li>
						@else
						<li role="presentation"><a href="{{ URL::route('getLogout') }}">Logout</a></li>
						@endif
					</ul>
					<div class="batas-tengah plus-atas"></div>
					<div class="row plus-atas">
						<div class="col-md-2">
							
						</div>
						<form method="post" action="{{ URL::route('artikel-search') }}">
							<div class="col-md-6">
								<input type="text" class="form-control searchbar" name="title" id="title"></input>
							</div>
							<div class="col-md-4">
								<input type="submit" value="Search" class="btn btn-success btn-block"></input>
							</div>
						</form>
					</div>		
				</div>
			</div>
		</div>
	</div>

	<div class="batas-tengah"></div>

	<div class="container plus-atas">
		<div class="row">
			<div class="col-md-3 well well_custom">
				<ul class="nav nav-pills nav-stacked">
					<li role="presentation"><a href="#">My Account, Downloads</a></li>
					<li role="presentation" class="{{$nav == 'archieve' || null ? 'active' : ''}}"><a href="{{ URL::route('archive-home') }}">Journal Archive</a></li>
					<li role="presentation"><a href="#">Forthcoming</a></li>
					<li role="presentation" class="{{$nav == 'supplements' || null ? 'active' : ''}}"><a href="{{ URL::route('supplements') }}">Online Supplements</a></li>
					<li role="presentation" class="nav-level2">Information for Authors</li>
					<li role="presentation" class="nav-level3 {{$nav == 'i_auth' || null ? 'active' : ''}}"><a href="{{ URL::route('i-auth-main') }}">Instruction for Authors</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Submitting Manuscripts</a></li>
					<li role="presentation" class="nav-level2">Editorial Information</li>
					<li role="presentation" class="nav-level3"><a href="#">About Jurnal Logic</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Editorial Board</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Journal & Author Roles</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Editorial Statements</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Reviewing for Jurnal Logic</a></li>
					<li role="presentation" class="nav-level2">Subscriptions</li>
					<li role="presentation" class="nav-level3"><a href="#">Subscribe to Jurnal Logic</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Purchase Articles</a></li>
					<li role="presentation" class="nav-level3"><a href="#">Purchase Back Issues</a></li>
				</ul>
			</div>
			<div class="col-md-9 main-content">
				@yield('content')
			</div>		
		</div>
	</div>

	<div class="custom_info">
		@if(Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>
		@elseif (Session::has('fail'))
			<div class="alert alert-danger">{{ Session::get('fail') }}</div>
		@endif
	</div>

	<footer class="footer">
		<div class="container">
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
