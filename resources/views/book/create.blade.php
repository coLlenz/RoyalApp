@extends('layouts.dashboard')

@section('action-btn')
<a href="{{ route('author.show', ['id' => $aid]) }}">Back</a>
@endsection

@section('content')
{{ Form::open(array('route' => 'book.store', 'method' => 'post')) }}
{{ Form::hidden('author[id]', $aid) }}
<div class="">
	@if(session()->has('error'))
		<div class="alert alert-danger text-center">
			{{ session()->get('error') }}
		</div>
	@endif
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Title') }}</label>
		{{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Title')]) }}
		@error('title')
			<span class="invalid-title text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Release Date') }}</label>
		{{ Form::date('release_date', null, ['class' => 'form-control']) }}
		@error('release_date')
			<span class="invalid-release_date text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Description') }}</label>
		{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
		@error('description')
			<span class="invalid-description text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('ISBN') }}</label>
		{{ Form::text('isbn', null, ['class' => 'form-control', 'placeholder' => __('Enter ISBN')]) }}
		@error('isbn')
			<span class="invalid-isbn text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3">
		<label class="form-label">{{ __('Format') }}</label>
		{{ Form::radio('format', 'string', ['class' => 'form-control', 'checked' => true]) }} String<br/>
		@error('format')
			<span class="invalid-format text-danger" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group mb-3" style="display:none;">
		<label class="form-label">{{ __('Number of Pages') }}</label>
		{{ Form::number('number_of_pages', 0, ['class' => 'form-control', 'placeholder' => __('Enter Number of Pages')]) }}
		@error('number_of_pages')
			<span class="invalid-number_of_pages text-danger" role="alert">
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