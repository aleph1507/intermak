@extends('main')
@section('title', 'Edit Product')

@section('content')

	<div class="container">
		<div class="row">
			{!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT', 'files' => true]) !!}

				<div class="col-md-8">
					{{ Form::label('name', 'Name of the product:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::label('gender', 'Gender:', ['class' => 'form-spacing-top']) }}
					<select class="form-control" name="gender">
						<option value='Male' {{ $product->gender == 'Male' ? 'selected' : "" }}>Male</option>
						<option value='Female' {{ $product->gender == 'Female' ? 'selected' : "" }}>Female</option>
						<option value='Unisex' {{ $product->gender == 'Unisex' ? 'selected' : "" }}>Unisex</option>
					</select>

					{{ Form::label('category_id', 'Category:') }}
	    			<select class="form-control" name="category_id">
	    				@foreach($categories as $category)
	    					<option value='{{ $category->id }}' {{ ($category->id == $cid)  ? 'selected' : '' }}>
	    						{{ $category->name }}
	    					</option>
	    				@endforeach
	    			</select>


					{{ Form::label('product_image', 'Upload Product Image', ['class' => 'form-spacing-top']) }}
					{{ Form::file('product_image', ['accept' => 'image/*']) }}

					{{ Form::label('gallery_images', 'Upload Product Gallery Images', ['class' => 'form-spacing-top']) }}
					{{ Form::file('gallery_images[]', ['multiple' => 'mulitple', 'accept' => 'image/*']) }}

					{{ Form::label('price', 'Price:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('price', null, ['class' => 'form-control']) }}

					{{ Form::label('oldprice', 'Old Price:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('oldprice', null, ['class' => 'form-control']) }}
				</div>

				<div class="col-md-4">
					<div class="well">
						<dl class="dl-horizontal">
							<dt>Created At:</dt>
							<dd>{{ date('M j, Y', strtotime($product->created_at)) }}</dd>
						</dl>

						<dl class="dl-horizontal">
							<dt>Last Updated:</dt>
							<dd>{{ date('M j, Y', strtotime($product->updated_at)) }}</dd>
						</dl>
						<hr>
						<div class="row">
							<div class="col-sm-6">
								{!! Html::linkRoute('products.show', 'Cancel', array($product->id), array('class' => 'btn btn-danger btn-block')) !!}
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