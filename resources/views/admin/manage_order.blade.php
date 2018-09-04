@extends('admin_layout')
@section('admin_content')

<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Oder List</h2>
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
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Order Id</th>
								  <th>Customer name</th>
								  <th>Shipping Name</th>
								  <th>order Total</th>
								  <th>order status</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 

						  <tbody>
						  	@foreach($all_order_info as $info)
							<tr>
								<td>{{$info->order_id}}</td>
								<td class="center">{{$info->customer_name}}</td>
								<td class="center">{{$info->shipping_first_name.' '.$info->shipping_last_name }}</td>
								<td class="center">{{$info->order_total}}</td>
								<td class="center">{{$info->order_status}}</td>
								{{-- <td class="center">
									
									<span class="label label-success">Active</span>
								
									<span class="label label-danger">NonActive</span>
									
								</td> --}}
								<td class="center">
									
									<a class="btn btn-danger" href="{{URL::to('unactive/'.$info->order_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									
									{{-- <a class="btn btn-success" href="{{URL::to('active_category/'.$info->category_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									 --}}
									<a class="btn btn-info" href="{{URL::to('order-view/'.$info->order_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('delete/'.$info->order_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						     @endforeach
					</div>
				</div><!--/span-->
			</div><!--/row-->
@endsection