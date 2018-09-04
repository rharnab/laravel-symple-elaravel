@extends('admin_layout')
@section('admin_content')
<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Forms</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>

					</div>
					<div class="box-content">
						<p class="alert-success">	
							<?php
							$message=Session::get('message');
							if($message){
								echo $message;
								Session::put('message',Null);
							}


							 ?>
						</p>
						<form class="form-horizontal" method="post" action="{{URL('/update_slider')}}" enctype="multipart/form-data">
							{{csrf_field()}}
						  <fieldset>

						  
							<div class="control-group">
							  <label class="control-label" for="date01">Slider Name</label>
							  <div class="controls">
								<input type="text"  name="slider_name" value="{{$slider_info->slider_name}}">
							  </div>
							</div>

							<img src="{{URL::to($slider_info->slider_image)}}" alt="" width="200" height="200" style="margin-left: 50px">
							 <div class="control-group">
								<label class="control-label">Slider Image</label>
								<div class="controls">
								  <input type="file" name="slider_image">
								</div>
							  </div>

							  

							


							<div class="form-actions">
								<input type="hidden" name="edit_id" value="{{$slider_info->slider_id}}">
							  <button type="submit" class="btn btn-primary">Update Slider</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection