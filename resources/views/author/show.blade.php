@extends('layouts.dashboard')

@section('action-btn')
<a href="{{ route('author.index') }}">Back</a>
@endsection

@section('content')
<div>
	<h1>Author</h1>

	<table>
		<tbody>
			<tr>
				<th>ID</th>
				<td>{{ $author->id }}</td>
			</tr>
			<tr>
				<th>Name</th>
				<td>{{ $author->first_name .' '. $author->last_name }}</td>
			</tr>
			<tr>
				<th>Birthday</th>
				<td>{{ date('M d, Y', strtotime($author->birthday)) }}</td>
			</tr>
			<tr>
				<th>Gender</th>
				<td>{{ $author->gender }}</td>
			</tr>
			<tr>
				<th>Place of Birth</th>
				<td>{{ $author->place_of_birth }}</td>
			</tr>
			<tr>
				<th></th>
				<td>
				@if(!$author->books)
				<form method="post" action="{{route('author.delete',['id'=>$author->id])}}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete"/>
				</form>
				@endif
				</td>
			</tr>
		</tbody>
	</table>
	
	<h1>Books</h1>
	<a href="{{ route('book.create', ['aid' => $author->id]) }}">Create Book</a>
	@if($author->books)
		@foreach($author->books AS $book)
			<div>
				{{ $book->title }} 
				<form method="post" action="{{route('book.delete',['id'=>$book->id])}}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete"/>
				</form>
			</div>
		@endforeach
	@else
		<div class="alert alert-warning">No records available</div>
	@endif
</div>
@endsection