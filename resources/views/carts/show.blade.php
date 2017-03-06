@extends('main')
@section('title', 'Cart')

@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if(($cart->products->isEmpty()) || ($cart==null))
					<h2 class="emptyCart">Your cart is currently empty.<br>
						<small>Return to the <a href="{{ route('products.index') }}">shop</a> to fill it.</small></h2>
				@else
					<table class="table table-responsive">
						<thead>
							<th>Name</th>
							<th>Price</th>
						</thead>
						<tbody>
							@foreach($cart->products as $product)
								<tr>
									<td>{{ $product->name }}</td>
									<td>{{ $product->price }}</td>
									<td> 
										{!! Form::open(['route' => ['cart.remove', $product->id], 'method' => 'POST']) !!}

											{{ Form::submit('Remove Product', ['class' => 'btn btn-xs btn-danger']) }}

										{!! Form::close() !!}			 
									</td>
								</tr>
							@endforeach
								<tr>
									<td>Total:</td>
									<td></td>
									<td>{{ $cart->total_price }} den</td>
								</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-success btn-block btn-checkout">Checkout</button>
				@endif
			</div>
		</div>
	</div>

@stop