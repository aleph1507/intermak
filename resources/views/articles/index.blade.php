@extends('main')
@section('title', 'Articles')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h1>All Articles</h1>
			</div>

			<div class="col-md-2">
				@if($role=="administrator")
					<a href="{{ route('articles.create') }}" class="btn btn-large btn-block btn-primary">
						Create New Article
					</a>
				@endif
			</div>
		</div>

		{{-- 
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<th>#</th>
						<th>Title</th>
						<th>Body</th>
						<th>Created At</th>
						<th></th>
					</thead>

					<tbody>
						
						@foreach($articles as $article)
							<tr>
								<th>{{ $article->id }}</th>
								<td>{{ $article->title }}</td>
								<td>{!! substr(strip_tags($article->body), 0, 50) !!}
									{!! strlen(strip_tags($article->body)) > 50 ? "..." : "" !!}
								</td>
								<td>{{ date('M j, Y', strtotime($article->created_at)) }}</td>
								<td>
									<a href="{{ route('articles.show', $article->id) }}"
										class="btn btn-default btn-sm">View</a>
									<a href="{{ route('articles.edit', $article->id) }}"
										class="btn btn-default btn-sm">Edit</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{!! $articles->links(); !!}
				</div>
			</div>
		</div>--}}

		{{--<div class="container">--}}
			<div class="row articles-row">
				@foreach($articles as $article)

					<div class="col-md-5 col-md-offset-1 col-sm-12 article-lg-wrap">
						@if(isset($article->image))
							<img src="{{ asset('images/article_images/thumbnails/' . $article->image) }}"  class="img-circle">
						@endif
						<h2>{{ $article->title }}<small style="float:right;">{{ date('M j, Y', strtotime($article->created_at)) }}</small></h2>
						<p class="lead">
							{!! substr(strip_tags($article->body),0,150) !!}
							{!! strlen(strip_tags($article->body)) > 150 ? "..." : "<br>" !!}
							<a href="{{ route('articles.show', $article->id) }}">Read More</a>
						</p>
					</div>

				@endforeach
			</div>
		{{--</div>--}}

	</div>

@stop