@extends('main')
@section('title', 'Administration')

@section('content')

	<div class="container">
		<h2>Administrators:</h2>
		<div class="row">
			<div class="col-md-8">
				<table class="table table-responsive">
					<thead>
						<th>#</th>
						<th>Email</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($administrators as $administrator)
							<tr>
								<td>{{ $administrator->id }}</td>
								<td>{{ $administrator->email }}</td>
								<td>
									{!! Form::open(['route' => ['administrators.destroy', $administrator->id], 'method' => 'DELETE']) !!}
											{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-small']) }}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="well">
					<h2>New Administrator</h2>
					{!! Form::open(['route' => 'administrators.store', 'method' => 'POST']) !!}

						{{ Form::label('email', 'Email:') }}
						<select class="form-control" name="email">
							@foreach($users as $user)
								<option value="{{ $user->email }}">{{ $user->email }}</option>
							@endforeach
						</select>

						{{ Form::submit('Add Administrator', ['class' => 'btn btn-primary btn-block']) }}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<div class="container">
	<h2>Users:</h2>
		<div class="row">
			<div class="col-md-8 col-md-osset-2">
				<table class="table table-responsive">
					<thead>
						<th>User #</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Credit Card</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($users as $user)
			
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ isset($user->phone) ? $user->phone : "No phone"}}</td>
								<td>{{ isset($user->address) ? $user->address : "No address" }}</td>
								<td>{{ isset($user->creditcard) ? $user->creditcard : "No credit card" }}</td>
								<td>
									{!! Form::open(['route' => ['user.delete', "id=".$user->id], 'method' => 'DELETE']) !!}
		
										{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-small']) }}
										
									{!! Form::close() !!}
								</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection