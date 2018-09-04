@extends('admin_layout')
@section('admin_content')





<div id="content" class="span10">		

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>


						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>

					</div>
					<p class="alert-success">
						<?php
						 $message=Session::get('message');
						 if($message){
						 	echo $message;
						 	Session::put('message',Null);
						 }
						 ?>
					</p>

					
					<div class="box-content">
						<div class="customer">
							<h2>Customer Details</h2>
							<table border="2px">
								<tr>
									<td >customer user name</td>
									<td >Customer mobile</td>
								</tr>
								
								@foreach($order_by_id as $v_order)
								<tr>
									<td>{{$v_order->customer_name}}</td>
									<td>{{$v_order->customer_mobile}}</td>
								</tr>
								@endforeach
								
							</table>							
						</div>

						<div class="customer" style="float: right; margin-top: -53px;">
							<h2>Shipping Details</h2>
							<table border="2px">
								<tr>
									<td > user name</td>
									<td > Address</td>
									<td >mobile</td>
								</tr>
								@foreach($order_by_id as $v_order)
								<tr>
									<td>{{$v_order->shipping_first_name}}</td>
									<td>{{$v_order->shipping_address}}</td>
									<td>{{$v_order->shipping_mobile_number}}</td>
								</tr>
								@endforeach
							</table>							
						</div>


						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th> Id</th>
								  <th>Product name</th>
								  <th>product Price</th>
								  <th>product salse quantity</th>
								  <th>product sub totall</th>
							  </tr>
						  </thead> 

						  <tbody>
						  @foreach($order_by_id as $v_order)
							<tr>
								<td class="center">{{$v_order->product_id}}</td>
								<td class="center">{{$v_order->product_name}}</td>
								<td class="center">{{$v_order->product_price}}</td>
								<td class="center">{{$v_order->product_sales_quantity}}</td>
								<td class="center">{{$v_order->product_price* $v_order->product_sales_quantity}}</td>
								
							</tr>
							@endforeach
						  </tbody>
						  <tfoot>
						  	<tr>
						  		<td >Totall WIth Bat</td>
						  		<td ><strong>={{$v_order->order_total}}</strong></td>
						  	</tr>
						  </tfoot>
						  </table>  
					</div>
				</div><!--/span-->
			</div><!--/row-->
@endsection