@extends('layouts.dashboard')

@section('action-btn')
<a href="{{ route('author.index') }}">Back</a>
@endsection

@section('content')
{{ Form::open(array('route' => 'author.store', 'method' => 'post')) }}
<div class="">
	@if(session()->has('error'))
		<div class="alert alert-danger text-center">
			{{ session()->get('error') }}
		</div>
	@endif
	<div class="form-group mb-3">
		<label class="form-label">{{ __('First Name') }}</label>
		{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => __('Enter First Name')]) }}
		@error('first_name')
			<span class="invalid-first_name text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Last Name') }}</label>
		{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Last Name')]) }}
		@error('last_name')
			<span class="invalid-last_name text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Birth Date') }}</label>
		{{ Form::date('birthday', null, ['class' => 'form-control']) }}
		@error('birthday')
			<span class="invalid-birthday text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Gender') }}</label>
		{{ Form::radio('gender', 'male', ['class' => 'form-control', 'checked' => true]) }} Male<br/>
		{{ Form::radio('gender', 'female', ['class' => 'form-control']) }} Female
		@error('gender')
			<span class="invalid-gender text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Place of birth') }}</label>
		{{ Form::text('place_of_birth', null, ['class' => 'form-control', 'placeholder' => __('Enter Place Of Birth')]) }}
		@error('place_of_birth')
			<span class="invalid-place_of_birth text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="d-grid">
		{{ Form::submit(__('Save'), ['class' => 'btn btn-primary btn-block mt-2', 'id' => 'saveBtn']) }}
	</div>

</div>
{{ Form::close() }}  
@endsection