@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('css/cart-style.css') }}">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/cartjs.js') }}"></script>

@section('content')

<div class="container">
	<section id="cart"> 
		<?php $final_amount = 0; ?>
		@foreach ($products as $product)
		<article class="product">
			<header>
				<a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" class="remove">
					<img src="{{ $product -> path }}" alt="">

					<h3>Remove product</h3>
				</a>
				<form action="/cart/delete" method="post" id="delete-form" accept-charset="utf-8" hidden>
					{{ csrf_field() }}
					<input type="hidden" name="product_id" value="{{ $product -> product_id }}">
					<input type="hidden" name="cart_id" value="{{ $product -> cart_id }}">
				</form>
			</header>

			<div class="content">

				<h1>{{ $product -> name }}</h1>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, numquam quis perspiciatis ea ad omnis provident laborum dolore in atque.
				<div style="top: 0px" class="type small">{{ $product -> barcode }}</div>
			</div>
			
			<footer class="content">
				<a href="#" onclick="event.preventDefault(); document.getElementById('update-form').submit();" class="type small update">
					UPDATE
				</a>
				<form action="/cart/update" method="POST" id="update-form" accept-charset="utf-8" hidden>
					{{ csrf_field() }}
					<input type="hidden" name="quantity" id="quantity">
					<input type="hidden" name="product_id" value="{{ $product -> product_id }}">
				</form>
				<span class="qt-minus" onclick="minusQuantity()">-</span>
				<span class="qt" id="quantity_value">{{ $product -> quantity }}</span>
				<span class="qt-plus" onclick="addQuantity()">+</span>

				<script type="text/javascript">
					function addQuantity() {
						var value = parseInt($("#quantity_value").text())+1;
						var lower = $("#quantity").val(value);
					}

					function minusQuantity() {
						var value = parseInt($("#quantity_value").text())-1;
						var lower = $("#quantity").val(value);
					}
				</script>

				<h2 class="full-price">
					<i class="fa fa-btc" aria-hidden="true"></i>
					<?php
						$price = $product -> amount;
						$quantity = $product -> quantity;
						$each = $price * 0.012;

						$subtotal = $price * $quantity;
						$final_amount += $subtotal;
						echo $subtotal;
					?>
				</h2>
				<h2 class="price">
					{{ $product -> amount }} <i class="fa fa-btc" aria-hidden="true"></i> 
				</h2>
			</footer>
		</article>
		@endforeach
	</section>
</div>
<footer id="site-footer">
	<div class="container clearfix">
		<div class="left">
			<h2 class="subtotal">Subtotal: <span>{{ $final_amount }}</span>.00 <i class="fa fa-btc" aria-hidden="true"></i></h2>
			<h3 class="tax" id="tax">Taxes (1.2%): <span><?php $tax = $final_amount*0.012; echo $tax; ?></span> <i class="fa fa-btc" aria-hidden="true"></i></h3>
			<h3 class="shipping">Shipping: <span><?php $shipping = 3; echo $shipping; ?>.00</span> <i class="fa fa-btc" aria-hidden="true"></i></h3>
		</div>
		<div class="right">
			<h1 class="total">Total:
				<span>
					<?php
						$for_checkout = $final_amount + $tax + $shipping;
					?>
					{{ $for_checkout }}
				</span>
				<i class="fa fa-btc" aria-hidden="true"></i>
			</h1>
			<!-- PAYPAL PAYMENT -->
                <?php  $count = 0; ?>
                <form style="text-align: center;">
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="upload" value="1">
                    <!-- The value property holds the business email -->
                    <input type="hidden" name="business" value="gadget-store@gmail.com">
                    
                    <!-- PRODUCT INFO -->
                    @foreach ($products as $product)
                        <?php $count ++; ?>
                        <input type="hidden" name="item_name_{{ $count }}" value="{{ $product -> name }}">
                        <input type="hidden" name="item_number_{{ $count }}" value="{{ $product -> barcode }}">
                        <input type="hidden" name="amount_{{ $count }}" value="{{ $product -> amount }}">
                        <input type="hidden" name="quantity_{{ $count }}" value="{{ $product -> quantity }}">

                        <!-- SURCHARGES -->
                        <input type="hidden" name="shipping_{{ $count }}" value="{{ $shipping }}">
                        <input type="hidden" name="tax_{{ $count }}" value="{{ $each }}">

                        <input type="hidden" name="return" id="cancel_return" value="http://localhost:8000">
                        <input type="hidden" name="cancel_return" id="cancel_return" value="http://localhost:8000/cart/{{ Auth::user()->name.Auth::user()->user_id.str_random(10) }}">
                    @endforeach
                    <br>

                    <!-- To implement in live, remove 'sandbox'. -->
                    <input name="submit" formaction="https://www.sandbox.paypal.com/cgi-bin/webscr" type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/gold-pill-paypalcheckout-34px.png">
                </form>
		</div>
	</div>
</footer>

@endsection