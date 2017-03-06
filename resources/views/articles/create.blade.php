@extends('main')

@section('title', 'Create Article')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			{!! Form::open(['route' => 'articles.store', 'files' => true]) !!}

				{{ Form::label('title', 'Title:', ['class' => 'form-spacing-top']) }}
				{{ Form::text('title', null, ["class" => "form-control"]) }}

				{{ Form::label('featured_image', 'Upload Featured Image:', ['class' => 'form-spacing-top']) }}
				{{ Form::file('featured_image') }}

				{{ Form::label('body', 'Article Body:', ['class' => 'form-spacing-top']) }}
				{{ Form::textarea('body', null, ['class' => 'form-control tmcetext']) }}

				{{ Form::submit('Create Article', ['class' => 'btn btn-success btn-lg btn-block form-spacing-top form-large-spacing-bottom']) }}

			{!! Form::close() !!}
			

		</div>
	</div>

@stop