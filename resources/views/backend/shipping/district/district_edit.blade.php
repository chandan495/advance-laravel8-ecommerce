@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
            <div class="col-6">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit District</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('district.update')}}" >
           @csrf
             <div class="row">
               <div class="col-12">	
                <input type="hidden" name="id" value="{{ $shipdistrict->id }}">
               <div class="form-group">
                       <h5>District Name <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <select name="division_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Division</option>
								@foreach($shipdivision as $division)
								<option value="{{ $division->id }}" {{ $division->id == $shipdistrict->division_id ? 'selected':'' }}>{{ $division->division_name }}</option>

                                

								@endforeach
                            </select>
                           <!-- <input type="text"  name="category_id" class="form-control"  >  -->
						   @error('division_id')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>
               
                    <div class="form-group">
                       <h5>District Name <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" value="{{ $shipdistrict->district_name }}"  name="district_name" class="form-control"  > 
						   @error('district_name')
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