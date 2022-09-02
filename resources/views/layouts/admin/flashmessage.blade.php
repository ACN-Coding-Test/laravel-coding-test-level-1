@if (session()->has('flash_message'))
	<div id="overlay" class="msg msg--{{session('flash_message_level')}}">
		{{ session('flash_message') }}
	</div>
@endif