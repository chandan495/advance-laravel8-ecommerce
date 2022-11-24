@extends('frontend.main_master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('content')

@section('title')
Check Out Page
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
					
					<form class="register-form" action="{{ route('checkout-store') }}" method="POST">
					@csrf
						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Name</b>  <span>*</span></label>
					    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="shipping_name" placeholder="Shipping Name" value="{{ Auth::user()->name }}">
					  </div>
                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Email</b> <span>*</span></label>
					    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="shipping_email" placeholder="Email"  value="{{ Auth::user()->email }}">
					  </div>
                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Phone</b> <span>*</span></label>
					    <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="shipping_phone" placeholder="phone"  value="{{ Auth::user()->phone }}">
					  </div>
                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Post Code</b> <span>*</span></label>
					    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="post_code" placeholder="Postal Code"  value="">
					  </div>
					 
					
				</div>	
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
				<div class="form-group">
	<h5><b>Division Select</b>  <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="division_id" class="form-control" required >
			<option value="" selected="" disabled="">Select Division</option>
			@foreach($divisions as $division)
 <option value="{{ $division->id }}">{{ $division->division_name }}</option>	
			@endforeach
		</select>
		@error('division_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

		 <div class="form-group">
	<h5><b>District Select</b>  <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="district_id" class="form-control" required >
			<option value="" selected="" disabled="">Select District</option>
			<!-- @foreach($divisions as $division)
 <option value="{{ $division->id }}">{{ $division->division_name }}</option>	
			@endforeach -->
		</select>
		@error('district_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

		 <div class="form-group">
	<h5><b>State Select</b> <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="state_id" class="form-control" required >
			<option value="" selected="" disabled="">Select State</option>
			<!-- @foreach($divisions as $division)
 <option value="{{ $division->id }}">{{ $division->division_name }}</option>	
			@endforeach -->
		</select>
		@error('state_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

		 <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Notes:<span>*</span></label>
					    <textarea class="form-control" name="notes" cols="30" rows="5" placeholder="Notes"> </textarea>
					  </div>
					
					
					  <!-- <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button> -->
					
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					   
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
                    @foreach($carts as $item)
                    
					<li style="width:50%;float:left">
                    <img src="{{ asset($item->options->image) }}" style="width:50px;height:50px;" />
                    
                    </li>
                    
					<li style="width:50%; float:left;">
                    <strong style="margin-right:20%">Qty:</strong>{{ $item->qty }}<br/>
                    <strong style="margin-right:20%" >Size:</strong>{{ $item->options->size }}<br/>
                    <strong style="margin-right:20%">Color:</strong>{{ $item->options->color }}
                    
                    </li>
                    <li style="margin-top:70px;margin-bottom:20px;"><hr></li>
                    @endforeach
                    <li style="margin-top:70px;margin-bottom:20px;"><hr></li>
                    @if(Session::has('coupon'))
                    <li><strong>Subtotal:</strong>$ {{ $cartTotal }}
                    <hr/>
                    </li>
					<li><strong>Coupon Name</strong> {{ session()->get('coupon')['coupon_name']  }} ({{ session()->get('coupon')['coupon_discount']}} %) <hr/>
                    </li>
                    <li><strong>Coupon Discount:&nbsp;</strong>$ {{ session()->get('coupon')['discount_amount']  }} <hr/>
                    </li>
                    <li><strong>Grand Total</strong>:&nbsp;$ {{ session()->get('coupon')['total_amount']  }} <hr/>
                    </li>
                    @else
                    <li><strong>Sub Total:</strong>:&nbsp;$ {{ $cartTotal }}
                    <hr/>
                    </li>
					<li><strong>Grand Total</strong>:&nbsp;$ {{ $cartTotal }}</li>
                    @endif
					
                    
				</ul>		
			</div>
		</div>
	</div>
</div> 


<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Payment Method</h4>
		    </div>
		    <div class="row">
				<div class="col-md-4">
				<label for="">Stripe</label>
				<input type="radio" name="payment_method" value="Stripe"/>
				<img src="{{ asset('frontend/assets/images/payments/4.png') }}" />
				</div>	
				<div class="col-md-4">
				<label for="">Card</label>
				<input type="radio" name="payment_method" value="card"/>
				<img src="{{ asset('frontend/assets/images/payments/3.png') }}" />
				</div>	
				<div class="col-md-4">
				<label for="">Cash</label>
				<input type="radio" name="payment_method" value="cash"/>
				<img src="{{ asset('frontend/assets/images/payments/2.png') }}" />
				</div>		
			</div>
			<hr>
			<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
		</div>
	</div>
</div> 

<!-- checkout-progress-sidebar -->				</div>
</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="division_id"]').on('change',function(){
            
            var division_id= $(this).val();
            if(division_id){
                //alert("going well");
                $.ajax({
                    
                    url: "{{ url('/district-get/ajax') }}/"+division_id,
                    type: "GET",
                    dataType:"json",
                  
                    success:function(data){
						$('select[name="state_id"]').html('');
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                          $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name+ '</option>');
                        });
                        
                        
                    },
                });
            }else{
                alert('danger');
            }
        });

		$('select[name="district_id"]').on('change',function(){
            
            var district_id= $(this).val();
            if(district_id){
                //alert("going well");
                $.ajax({
                    
                    url: "{{ url('/state-get/ajax') }}/"+district_id,
                    type: "GET",
                    dataType:"json",
                  
                    success:function(data){
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                          $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name+ '</option>');
                        });
                        
                        
                    },
                });
            }else{
                alert('danger');
            }
        });

    });
</script>

@endsection
