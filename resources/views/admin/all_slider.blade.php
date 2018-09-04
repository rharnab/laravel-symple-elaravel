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
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Slider List</h2>
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
								  <th>Slider Id</th>
								  <th>Slider Name</th>
								  <th>Slider image</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 

						   <tbody>
						  	@foreach($all_slider_info as $info)
							<tr>
								<td >{{$info->slider_id}}</td>
								<td  class="center">{{$info->slider_name}}</td>
							
								<td  class="center"><img src="{{URL::to($info->slider_image)}}" alt="" width="100" ></td>
								<td  class="center">
									<?php if($info->publication_status==1){?>
									<span class="label label-success">Active</span>
									<?php } else { ?>
									<span class="label label-danger">NonActive</span>
									<?php } ?>
								</td>
								<td class="center">
									@if($info->publication_status==1)
									<a class="btn btn-danger" href="{{URL::to('unactive_slider/'.$info->slider_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('active_slider/'.$info->slider_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif
									<a class="btn btn-info" href="{{URL::to('edit-slider/'.$info->slider_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('delete-slider/'.$info->slider_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						     @endforeach
						  	
					</div>
				</div><!--/span-->
			</div><!--/row-->
@endsection