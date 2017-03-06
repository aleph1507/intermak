@extends('main')
@section("title", "Not Authorized")

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-danger">'Not Authorized to View This Page' </div>
				<a href="{{ url('/') }}" class="btn btn-primary btn block">Return to Homepage</a>
			</div>
		</div>
	</div>

@endsection