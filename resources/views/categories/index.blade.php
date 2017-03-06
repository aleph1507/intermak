@extends('main')
@section('title', 'Categories')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th></th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						@foreach($categories as $category)

							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>
									{!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}

										{{ Form::text("name".$category->id, null, ['class' => 'rename-text']) }}
										{{ Form::submit('Rename', ['class' => 'btn btn-success btn-xs xss-btn']) }}

									{!! Form::close() !!}
								</td>
								<td>
									{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}

									{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs xss-btn']) }}

									{!! Form::close() !!}
								</td>
							</tr>
						
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="well">
					
					{!! Form::open(['route' => 'categories.store', 'method' =>'POST']) !!}

						<h2>New Category</h2>
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}

						{{ Form::submit('Create Category', ['class' => 'btn btn-primary btn-block']) }}

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>

@stop