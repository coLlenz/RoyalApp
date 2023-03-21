<!DOCTYPE html>
<html lang="en">
	<head>
		<title>{{ config('app.name', 'RoyalApps') }}</title>
		<link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" sizes="16x16">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
		<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
		@stack('css-page')
	</head>
	<body>
		<a href="{{ route('auth.logout') }}">Logout</a>
		
		<ul>
			<li class="{{ in_array(\Request::route()->getName(), $routes)? ' active' : ''}}">
				<a href="{{ route('dashboard.index') }}">Dashboard</a>
			</li>
			<li class="{{ in_array(\Request::route()->getName(), $routes)? ' active' : ''}}">
				<a href="{{ route('author.index') }}">Authors</a>
			</li>
			<li class="{{ in_array(\Request::route()->getName(), $routes)? ' active' : ''}}">
				<a href="{{ route('book.index') }}">Books</a>
			</li>
		</ul>
		
		@yield('action-btn')
		
		@if(session()->has('error'))
			<div class="message-wrapper alert alert-danger text-center">
				{{ session()->get('error') }}
			</div>
		@endif
		@if(session()->has('success'))
			<div class="message-wrapper alert alert-success text-center">
				{{ session()->get('success') }}
			</div>
		@endif
		
		
		@yield('content')
		@stack('script-page')
	</body>
</html>