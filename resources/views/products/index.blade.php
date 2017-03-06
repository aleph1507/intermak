@extends('main')
@section('title', 'Products')

@section('content')

	<div class="container">

		<div class="row">
			<div class="col-md-8"><h2>All Products</h2></div>
			<div class="col-md-4">
				@if($role=="administrator")
					<a href="{{ route('products.create') }}" class="btn btn-large btn-primary">Add New Product</a>
				@endif
			</div>
		</div>


		<div class="row pgselect">
			<div class="col-md-3">
				{{ Form::open(['route' => 'products.index', 'method' => 'GET']) }}


				{{ Form::label('selectgender', 'See Products For:', ['class' => 'form-spacing-top']) }}
				<select class="form-control" name="selectgender">
					<option value='Unisex' {{ $selected == 'both' ? 'selected' : "" }}>Both Sexes</option>
					<option value='Male' {{ $selected == 'Male' ? 'selected' : "" }}>Male</option>
					<option value='Female' {{ $selected == 'Female' ? 'selected' : "" }}>Female</option>
				</select>
			</div>

			<div class="col-md-3">
				{{ Form::label('selectcategory', 'Select Category:', ['class' => 'form-spacing-top']) }}
				<select class="form-control" name="selectcategory">
					@foreach($categories as $category)	
						<option value="{{ $category->id }}" {{ $selectedcategory == $category->id ? "selected" : "" }}>
							{{ $category->name }}
						</option>
					@endforeach
				</select>
			</div>
				
			<div class="col-md-2">
				{{ Form::submit('Go', ['class' => 'btn btn-danger btn-lg-spacing-top']) }}

				{{ Form::close() }}
			</div>

			<div class="col-md-4"></div>

		</div>
				

		<div class="row">
			@foreach($products as $product)
				<div class="col-md-5 thumbnail product-wrap productbox">
					@if(isset($product->image))
						<img src="{{ asset('images/product_images/product_thumbnails/' . $product->image) }}" alt="product image" 
							class="img-responsive img-rounded">
					@endif
					<h2>{{ $product->name }}</h2>
					<h3>{{ $product->price }}</h3>
					<a href="{{ route('products.show', $product->id) }}" class="btn btn-danger btn-block btn-more">See more about {{ $product->name }}</a>
					{{ Form::open(['route' => ['cart.add', $product->id], 'method' => 'POST']) }}
						{{ Form::submit("Add to Cart", ['class' => 'btn btn-primary']) }}{{--<div class="bigger-glyph"><i class='fa fa-shopping-cart' aria-hidden='true'></i></div>--}}
					{{--<a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</a>--}}
					{{ Form::close() }}
					@if($role=="administrator")
						<table class="table-responsive">
							<tr>
								<!--<td style="width:30%;"></td>-->
								<td style="width:40%;">
									<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
								</td>
								<td style="width:10%"></td>
								<td style="width:40%; padding-top:5%;">
									{!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) !!}

										{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

									{!! Form::close() !!}
								</td>
							</tr>
						</table>
					@endif
				</div>
			@endforeach
		</div>
		<div class="text-center">
			{!! $products->links() !!}
		</div>
	</div>

@stop