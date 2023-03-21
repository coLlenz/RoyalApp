@extends('layouts.dashboard')

@section('action-btn')
<a href="{{ route('author.create') }}">Create Author</a>
@endsection

@section('content')
<div>
	<h1>Authors</h1>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Birth Date</th>
				<th>Gender</th>
				<th>Place of Birth</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		@if($authors && $authors->total_results > 0)
			@foreach($authors->items AS $author)
			<tr>
				<td>{{ $author->id }}</td>
				<td>{{ $author->first_name .' '. $author->last_name }}</td>
				<td>{{ date('M d, Y', strtotime($author->birthday)) }}</td>
				<td>{{ $author->gender }}</td>
				<td>{{ $author->place_of_birth }}</td>
				<td>
				@php 
				$author_details = \App\Helpers\SymfonySkeletonHelper::getAuthor($author->id);
				@endphp
				
				<a href="{{route('author.show', ['id'=>$author->id])}}">View</a>
				@if(!$author_details->books)
				<form method="post" action="{{route('author.delete',['id'=>$author->id])}}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete"/>
				</form>
				@endif
				</td>
			</tr>
			@endforeach
		@else
			<tr>
				<td colspan="6">
					<div class="alert alert-danger">No records available</div>
				</td>
			</tr>
		@endif
		</tbody>
	</table>
</div>
@endsection