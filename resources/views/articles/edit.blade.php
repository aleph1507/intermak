@extends('main')
@section('title', 'Edit Article')

@section('content')


	<div class="container">
		<div class="row">
			{!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'PUT', 'files' => true]) !!}

				<div class="col-md-8">
					{{ Form::label('title', 'Title', ['class' => 'form-spacing-top']) }}
					{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

					{{ Form::label('featured_image', 'Update Featured Image:', ['class' => 'form-spacing-top']) }}
					{{ Form::file('featured_image') }}

					{{ Form::label('body', "Body", ['class' => 'form-spacing-top']) }}
					{{ Form::textarea('body', null, ['class' => 'form-control tmcetext']) }}
				</div>

				<div class="col-md-4">
					<div class="well">
						<dl class="dl-horizontal">
							<dt>Created At:</dt>
							<dd>{{ date('M j, Y', strtotime($article->created_at)) }}</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>Last Updated:</dt>
							<dd>{{ date('M j, Y', strtotime($article->updated_at)) }}</dd>
						</dl>
						<hr>
						<div class="row">
							<div class="col-sm-6">
								{!! Html::linkRoute('articles.show', 'Cancel', array($article->id), array('class' => 'btn btn-danger btn-block')) !!}
							</div>
							<div class="col-sm-6">
								{{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}
							</div>
						</div>
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>

@stop