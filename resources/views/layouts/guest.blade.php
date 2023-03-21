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
		@yield('content')
		@stack('script-page')
	</body>
</html>