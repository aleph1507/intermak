@extends('main')
@section('title', 'View Article')

@section('content')

	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			@if(isset($article->image))
				<img src="{{ asset('images/article_images/' . $article->image) }}" alt="article image" class="article-image-top-spacing">
			@endif
			<h2 class="article-title">{{ $article->title }}</h2>

			<p class="lead">{!! $article->body !!}</p>
		</div>
		<div class="col-md-3">
			<div class="well">
				<a href="{{ URL::previous() }}" class="btn btn-primary btn-block">Back</a><br>

				@if($role=="administrator")
					{!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

					{!! Form::close() !!}
				@endif
			</div>
		</div>
	</div>	

@stop