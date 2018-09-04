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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Menufecture</h2>
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
						<form class="form-horizontal" method="post" action="{{URL('/save_menufecture')}}">
							{{csrf_field()}}
						  <fieldset>

						  <p class="alert-danger">	<?php foreach($errors->get('menufecture_name') as $message) echo $message; ?> </p>
							<div class="control-group">
							  <label class="control-label" for="date01">Menufecture Name</label>
							  <div class="controls">
								<input type="text"  name="menufecture_name" >
							  </div>
							</div>

			          	<p class="alert-danger"><?php foreach($errors->get('menufecture_description') as $message) echo $message ?></p>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Menufecture Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" name="menufecture_description" rows="3"></textarea>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Menufecture  Status</label>
							  <div class="controls">
								<input type="checkbox"  name="publication_status" value="1">
							  </div>
							</div>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Menufecture </button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection