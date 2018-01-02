<div class="container">
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if (Session::has('flash_message'))
		<div class="alert alert-success">
			<ul>
				<li>{{ Session::get('flash_message') }}</li>
			</ul>
		</div>
	@endif
</div>
