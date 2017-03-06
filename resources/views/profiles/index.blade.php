@extends('main')
@section('title', 'Profile')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<p class="rightitalics lead">Member since: {{ $user->created_at }}<br>
											Last Update: {{ $user->updated_at }}</p>
				{!! Form::model($user, ['route' => ['profiles.update', $user->id], 'method' => "PUT"]) !!}

					{{ Form::label('name', 'Name:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::label('email', 'Email: ', ['class' => 'form-spacing-top']) }}
					{{ Form::text('email', null, ['class' => 'form-control']) }}

					{{ Form::label('phone', 'Phone:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('phone', null, ['class' => 'form-control']) }}

					{{ Form::label('address', 'Address:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('address', null, ['class' => 'form-control']) }}

					{{ Form::label('creditcard', 'Credit Card:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('creditcard', null, ['class' => 'form-control']) }}

					<div class="row">
						<div class="col-md-3">

						{{ Form::submit('Save Profile', ['class' => 'btn btn-danger btn-block form-spacing-top form-large-spacing-bottom']) }}
			
					{!! Form::close() !!}
						</div>
						<div class="col-md-6"></div>
						<div class="col-md-3">

							{!! Form::open(['route' => ['profiles.destroy', $user->id], 'method' => 'DELETE']) !!}

								{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block form-spacing-top form-large-spacing-bottom']) }}

							{!! Form::close() !!}
						</div>
					</div>
			</div>
		</div>
	</div>

@stop