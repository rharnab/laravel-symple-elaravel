@extends('layout')
@section('content');

 <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="col-md-9">
			<div class="table-responsive cart_info">
				<?php $contents=Cart::content() ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Item Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="total">Action</td>
							
						</tr>
					</thead>
					<tbody>
						<?php foreach($contents as $product) { ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($product->options->image)}}" alt="" style="width: 100px; height:100px "></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$product->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{$product->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart')}}" method="post">
										{{csrf_field()}}
										<input class="cart_quantity_input" type="text" name="qty" value="{{$product->qty}}" autocomplete="off" size="2">
										<input  type="hidden" name="rowId" value="{{$product->rowId}}">
										<input class="btn btn-sm" type="submit" name="submit" value="Update">
									</form>
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$product->total()}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('delete-to-cart/'.$product->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						
						

						<?php } ?>
					</tbody>
				</table>
			</div>

			<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::subtotal()}}</span></li>
							<li>Eco Tax <span>{{Cart::tax()}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total()}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<?php $shipping_id=Session::get('customer_id') ?>

							@if($shipping_id!=null)
							<a class="btn btn-default check_out" href="{{URl::to('/checkout')}}">Check Out</a>
							@else
								<a class="btn btn-default check_out" href="{{URl::to('/login-check')}}">Check Out</a>
							@endif
					</div>
				</div>
			</div>
		</div>
		
	
	</section> --><!--/#do_action-->
		
			</div>
		</div>
		
	</section> /#cart_items

	


@endsection