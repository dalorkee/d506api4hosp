<x-guest-layout>
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/error-page.css') }}" />
@endsection
<h1>DDS ERROR</h1>
<p class="zoom-area">Service Unavailable</p>
<section class="error-container">
	<span><span>5</span></span>
	<span>0</span>
	<span><span>3</span></span>
</section>
<div class="link-container">
	<a href="{{ route('dds.logout') }}" class="more-link">Back to Login</a>
</div>
</x-guest-layout>
