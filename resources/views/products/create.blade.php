@extends('main')
@section('title', 'Add Product')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{{ Form::open(['route' => 'products.store', 'files' => true]) }}

					{{ Form::label('name', 'Name of the product:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::label('gender', 'Gender:', ['class' => 'form-spacing-top']) }}
					<select class="form-control" name="gender">
						<option value='Male'>Male</option>
						<option value='Female'>Female</option>
						<option value='Unisex'>Unisex</option>
					</select>

					{{ Form::label('category_id', 'Category:') }}
	    			<select class="form-control" name="category_id">
	    				@foreach($categories as $category)
	    					<option value='{{ $category->id }}'> {{ $category->name }} </option>
	    				@endforeach
	    			</select>

					{{ Form::label('product_image', 'Upload Featured Product Image', ['class' => 'form-spacing-top']) }}
					{{ Form::file('product_image', ['accept' => 'image/*']) }}

					{{ Form::label('gallery_images', 'Upload Product Gallery Images', ['class' => 'form-spacing-top']) }}
					{{ Form::file('gallery_images[]', ['multiple' => 'mulitple', 'accept' => 'image/*']) }}

					{{ Form::label('price', 'Price:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('price', null, ['class' => 'form-control']) }}

					{{ Form::label('description', 'Description', ['class' => 'form-spacing-top']) }}
					{{ Form::textarea('description', null, ['class' => 'form-control tmcetext']) }}

					{{ Form::label('oldprice', 'Old Price:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('oldprice', null, ['class' => 'form-control']) }}

					{{ Form::submit('Add Product', ['class' => 'btn btn-success btn-lg btn-block form-spacing-top form-large-spacing-bottom']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop