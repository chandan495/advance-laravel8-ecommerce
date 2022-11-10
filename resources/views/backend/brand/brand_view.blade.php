@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			 

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Brand List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Brand English</th>
								<th>Brand Hindi</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($brands as $item)
							<tr>
								<td>{{ $item->brand_name_en }}</td>
								<td>{{ $item->brand_name_hin }}</td>
								<td><img src="{{ asset($item->brand_image) }}" style="width:70px; height:50px;border:2px solid #fff; padding:5px;"/></td>
								<td><a title="Edit Data"  class="btn btn-info" href="{{ route('edit.brand',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('brand.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a></td>
								
							</tr>
							
						@endforeach	
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			           
			</div>
            <div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Brand </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('brand.store')}}" enctype="multipart/form-data">
           @csrf
             <div class="row">
               <div class="col-12">	
               
                    <div class="form-group">
                       <h5>Brand Name English <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="brand_name_en" class="form-control"  > 
						   @error('brand_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Brand Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="brand_name_hin" class="form-control"   > 
						   @error('brand_name_hin')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Brand Image <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="file" name="brand_image" class="form-control"   > 
						   @error('brand_image')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>
                    </div>
                    
                    
               </div>
               
                  
               <div class="text-xs-right">
                   <input type="submit" name="submit" class="btn btn-primary mb-5" value="Add New"/>
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