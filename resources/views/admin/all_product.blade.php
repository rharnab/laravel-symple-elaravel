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
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Producdt List</h2>
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
								  <th>Product Id</th>
								  <th>Product Name</th>
								  <th>Category name</th>
								  <th>Menufecture name</th>
								  <th>Product Prize</th>
								  <th>Product image</th>
								  <th>Product size</th>
								  <th>Product color</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 

						  <tbody>
						  	@foreach($all_product_info as $info)
							<tr>
								<td width="5%">{{$info->product_id}}</td>
								<td width="5%" class="center">{{$info->product_name}}</td>
								<td width="5%" class="center">{{$info->category_name}}</td>
								<td width="5%" class="center">{{$info->menufecture_name}}</td>
								<td width="10%" class="center">{{$info->product_price}}</td>
								<td width="10%" class="center"><img src="{{URL::to($info->product_image)}}" alt="" width="100" ></td>
								<td width="10%" class="center">{{$info->product_size}}</td>
								<td width="10%" class="center">{{$info->product_color}}</td>
								<td width="5%" class="center">
									<?php if($info->publication_status==1){?>
									<span class="label label-success">Active</span>
									<?php } else { ?>
									<span class="label label-danger">NonActive</span>
									<?php } ?>
								</td>
								<td class="center">
									@if($info->publication_status==1)
									<a class="btn btn-danger" href="{{URL::to('unactive_product/'.$info->product_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('active_product/'.$info->product_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif
									<a class="btn btn-info" href="{{URL::to('edit-product/'.$info->product_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('delete-product/'.$info->product_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						     @endforeach
					</div>
				</div><!--/span-->
			</div><!--/row-->
@endsection