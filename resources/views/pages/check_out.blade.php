@extends('layout')
@section('content')
	
			

			<div class="register-req">
				<p>Please Fill up all field</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Shipping Address</p>
							<div class="form-one">
								<form action="{{URL::to('/save-shipping-details')}}" method="post">
									{{csrf_field()}}

									<?php foreach($errors->get('shipping_email') as $message) echo $message  ?>
									<input type="text" placeholder="Email" name="shipping_email">


									<?php foreach($errors->get('shipping_first_name') as $message) echo $message  ?>
									<input type="text" placeholder="First Name" name="shipping_first_name">


									<?php foreach($errors->get('shipping_last_name') as $message) echo $message  ?>
									<input type="text" placeholder="Last Name" name="shipping_last_name">


									<?php foreach($errors->get('shipping_address') as $message) echo $message  ?>
									<input type="text" placeholder="Address" name="shipping_address">


									<?php foreach($errors->get('shipping_mobile_number') as $message) echo $message  ?>
									<input type="text" placeholder="Shipping Mobile Number" name="shipping_mobile_number">


									<?php foreach($errors->get('shipping_city') as $message) echo $message  ?>
									<input type="text" placeholder="City" name="shipping_city">


									<input type="submit" name="submit" value="Done">
			
								</form>
							</div>
							
							</div>
						</div>
					</div>				
				</div>
			</div>
			
			
			
		</div>
	</section> 
@endsection