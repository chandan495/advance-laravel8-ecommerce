@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Update Coupon</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('coupon.update', $coupon->id)}}" >
           @csrf

           <input type="hidden" name="id" value="{{ $coupon->id }}">
             <div class="row">
               <div class="col-8">	
               
                    <div class="form-group">
                       <h5>Coupon Name<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" value="{{ $coupon->coupon_name }}"  name="coupon_name" class="form-control"  > 
						   @error('coupon_name')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Coupon Discount <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" value="{{ $coupon->coupon_discount }}" name="coupon_discount" class="form-control"   > 
						   @error('coupon_discount')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Coupon Validity <span class="text-danger">*</span></h5>
                       <div class="controls">
                       
                           <input value="{{ $coupon->coupon_validity }}" type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"  > 
						   @error('coupon_validity')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>
                    </div>
                    
                    
               </div>
               
                  
               <div class="text-xs-right">
                   <input type="submit" name="submit" class="btn btn-primary mb-5" value="Update"/>
               </div>
           </form>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			           
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
 

@endsection  