@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			 

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Shipping State List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                            <th>Division Name</th>
								<th>District Name</th>
                                <th>State Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($shipstates as $item)
							<tr>
							    <td>{{ $item->division->division_name }}</td>
                                <td>{{ $item->district->district_name }}</td>
								<td>{{ $item->state_name }}</td>
								<td><a title="Edit Data"  class="btn btn-info" href="{{ route('state.edit',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('state.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a></td>
								
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
				  <h3 class="box-title">Add State</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('state.store')}}" >
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
                            <select name="district_id" class="form-control">
                                <option value="" selected=""  disabled="">Select District</option>
								
                            </select>
                           <!-- <input type="text"  name="category_id" class="form-control"  >  -->
						   @error('district_id')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>
               
                    <div class="form-group">
                       <h5>State Name <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="state_name" class="form-control"  > 
						   @error('state_name')
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
      <script type="text/javascript">
    $(document).ready(function(){
        $('select[name="division_id"]').on('change',function(){
            
            var division_id= $(this).val();
            
            if(division_id){
                //alert(division_id);
                $.ajax({
                    
                    url: "{{ url('/shipping/district/ajax') }}/"+division_id,
                    type: "GET",
                    dataType:"json",
                  
                    success:function(data){
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
    });
</script>

@endsection  