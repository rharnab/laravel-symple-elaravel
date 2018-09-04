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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
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
						<form class="form-horizontal" method="post" action="{{URL('/update-product')}}" enctype="multipart/form-data">
							{{csrf_field()}}
						  <fieldset>

						 
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text"  name="product_name" value="{{$info->product_name}}">
							  </div>
							</div>

							
							<div class="control-group">
								<label class="control-label" for="selectError3">Category Select</label>
								<div class="controls">
								  <select id="selectError3" name="category_id">
								  	
								  	<?php
								  	$category=DB::table('tbl_category')->where('publication_status',1)->get();
								  	 ?>

								  	<?php foreach($category as $cat) {?>
										
									<option 
									<?php 
									if($info->category_id==$cat->category_id){
										echo 'selected';
									}
									?>

									value="{{$cat->category_id}}">{{$cat->category_name}}</option>
									
									<?php } ?>
								  </select>
								</div>
							  </div>


							 
							<div class="control-group">
								<label class="control-label" for="selectError3">Menufecture Select</label>
								<div class="controls">
								  <select id="selectError3" name="menufecture_id">
								<?php
								  	$menufecture=DB::table('tbl_menufecture')->where('publication_status',1)->get();

								  	 ?>
								  	 @foreach($menufecture as $menu)
								  	 <option
									<?php
									if($info->menufecture_id==$menu->menufecture_id){
										echo "selected";
									}

									?>

								  	  value="{{$menu->menufecture_id}}">{{$menu->menufecture_name}}</option>
								  	 @endforeach
								  </select>
								</div>
							  </div>

			          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product short Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" name="product_short_description" rows="3">{{$info->product_short_description}}</textarea>
							  </div>
							</div>

							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product long Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" name="product_long_description" rows="3">{{$info->product_long_description}}</textarea>
							  </div>
							</div>

						
							<div class="control-group">
							  <label class="control-label" for="date01">Product Prize</label>
							  <div class="controls">
								<input type="text"  name="product_price" value="{{$info->product_price}}">
							  </div>
							</div>
							
							
							 <div class="control-group">
							 <img src="{{URL::to($info->product_image)}}" alt="" style="width: 100px; height: 100px; float: center">
								<label class="control-label">Product Image</label>
								<div class="controls">
								  <input type="file" name="product_image">
								</div>
							  </div>

							  
							<div class="control-group">
							  <label class="control-label" for="date01">Product Size</label>
							  <div class="controls">
								<input type="text"  name="product_size" value="{{$info->product_size}}">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text"  name="product_color" value="{{$info->product_color}}">
							  </div>
							</div>

							

							<div class="form-actions">
								<input type="hidden" name="edit_id" value="{{$info->product_id}}">
							  <button type="submit" class="btn btn-primary">Update Product</button>
							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection