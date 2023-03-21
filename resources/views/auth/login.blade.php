@extends('layouts.guest')

@section('content')
{{ Form::open(array('route' => 'auth.login.store', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form form_data')) }}
<div class="">
	<div class="alert alert-info">
		Symfony Skeleton API 
	</div>
	@if(session()->has('error'))
		<div class="alert alert-danger text-center">
			{{ session()->get('error') }}
		</div>
	@endif
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Email') }}</label>
		{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')]) }}
		@error('email')
			<span class="invalid-email text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="form-group mb-3">
		<label class="form-label">{{ __('Password') }}</label>
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password')]) }}
		@error('password')
			<span class="invalid-password text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="d-grid">
		{{ Form::submit(__('Login'), ['class' => 'btn btn-primary btn-block mt-2', 'id' => 'saveBtn']) }}
	</div>

</div>
{{ Form::close() }}  
@endsection