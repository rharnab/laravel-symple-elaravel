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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Menfecture</h2>
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
						<form class="form-horizontal" method="post" action="{{URL('/update_menufecture')}}">
							{{csrf_field()}}
						  <fieldset>

						  
							<div class="control-group">
							  <label class="control-label" for="date01">Menufecture Name</label>
							  <div class="controls">
								<input type="text"  name="menufecture_name" value="{{$info->menufecture_name}}">
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">menufecture Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" name="menufecture_description" rows="3">
									{{$info->menufecture_description}}
								</textarea>
							  </div>
							</div>

							

							<div class="form-actions">
								<input type="hidden" name="edit_id" value="{{$info->menufecture_id}}">
							  <button type="submit" class="btn btn-primary">Update</button>
							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection