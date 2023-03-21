@extends('layouts.dashboard')

@section('content')
<div>
<h1>Dashboard</h1>

<p>Welcome <strong>{{ $user_data->user->first_name . ' '. $user_data->user->last_name }}</strong></p>
</div>
@endsection