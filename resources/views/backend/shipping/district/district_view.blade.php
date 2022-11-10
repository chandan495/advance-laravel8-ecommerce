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
				  <h3 class="box-title">Shipping District List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                            <th>Division Name</th>
								<th>District Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($shipdistrict as $item)
							<tr>
							    <td>{{ $item->division->division_name }}</td>
								<td>{{ $item->district_name }}</td>
								<td><a title="Edit Data"  class="btn btn-info" href="{{ route('district.edit',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('district.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a></td>
								
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
				  <h3 class="box-title">Add District</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('district.store')}}" >
           @csrf
             <div class="row">
               <div class="col-12">	

               <div class="form-group">
                       <h5>Division Name <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <select name="division_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Division</option>
								@foreach($shipdivision as $division)
								<option value="{{ $division->id }}">{{ $division->division_name }}</option>

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
                           <input type="text"  name="district_name" class="form-control"  > 
						   @error('district_name')
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