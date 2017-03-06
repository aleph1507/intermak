@extends('main')
@section('title', 'FAQ')

@section('content')

	<div class="container">
		<div class="row">
			
		</div>
	</div>
		
	@section('styles')
		<link href={{ asset("css/style_faq.css")}} rel="stylesheet">
	@stop

	<div class="container faq">
		<dl class="faq">
			<dt>How to shop online?</dt>
				<dd>
					In order to shop from our web shop you must provide us with your personal information by filling a form.

					When you’re finished shopping, click on “ADD TO CART” to place your order. Price, estimated  and availability will be displayed. You may also edit your order at this time. When you’re happy with your order, proceed to checkout.

					To save time the next time you shop, you can choose to save your credit card details on our secure server, so you won’t have to enter them every time you check out.

					Once you have placed your order, you will receive an email confirmation. An additional email will be sent to notify you that your order has shipped with a tracking link to trace your order.
				</dd>
				<hr>
			<dt>An item added to my shopping bag was suddenly sold out at checkout. How is this possible?</dt>
			<dd>
				The item is only reserved once your purchase is completed in the checkout. If an item is very popular, it might be available when you place it in your shopping bag, but sold out once you reach the checkout. An item added to your shopping bag is saved for 7 days, but availability cannot be guaranteed.
			</dd>
			<hr>

			<dt>How do I cancel or edit a placed order?</dt>
			<dd>
				-If the order has already been paid for cancellation could be done via phone call or email 24 hours after the order has been placed.
			</dd>
			
		</dl>
	</div>


@endsection