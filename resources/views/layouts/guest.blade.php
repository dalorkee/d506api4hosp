<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'DDS API') }}</title>
		<link type="text/css" rel="stylesheet" href="css/fonts.css">
		<style type="text/css">.min-h-screen{background: linear-gradient(to bottom, #0b2c3b 0%, #263544 100%)}</style>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		@yield('style')
	</head>
	<body>
		<div class="font-promt text-gray-900 antialiased">
			{{ $slot }}
		</div>
		@stack('script')
	</body>
</html>
