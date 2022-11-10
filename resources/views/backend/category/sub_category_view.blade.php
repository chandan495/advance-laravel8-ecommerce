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
				  <h3 class="box-title">Sub Sub Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category</th>
                                <th>SubCategory Name</th>
								<th>Sub->Sub Category English</th>
								<!-- <th>Sub->Sub Category Hin</th> -->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($subsubcategory as $item)
							<tr>
								<td>{{ $item['category']['category_name_en'] }}</td>
                                <td>{{ $item['subcategory']['sub_category_name_en'] }}</td>
								<td>{{ $item->subsub_category_name_en }}</td>
                                <!-- <td>{{ $item->subsub_category_name_hin }}</td> -->
								<td><a title="Edit Data"  class="btn btn-info" href="{{ route('subsubcategory.edit',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('subsubcategory.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a></td>
								
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
				  <h3 class="box-title">Add Sub Sub Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('subsubcategory.store')}}" >
           @csrf
             <div class="row">
               <div class="col-12">	
               
                    <div class="form-group">
                       <h5>Category English <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <select name="category_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Category</option>
								@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ $category->category_name_en }}</option>

								@endforeach
                            </select>
                           <!-- <input type="text"  name="category_id" class="form-control"  >  -->
						   @error('category_id')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>
                   <div class="form-group">
                       <h5>Sub Category English <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <select name="subcategory_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Sub Category</option>
								
                            </select>
                           <!-- <input type="text"  name="category_id" class="form-control"  >  -->
						   @error('subcategory_id')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub->Sub Category Name English <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="subsub_category_name_en" class="form-control"   > 
						   @error('subsub_category_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub->Sub Category Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="subsub_category_name_hin" class="form-control"   > 
						   @error('subsub_category_name_hin')
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
        $('select[name="category_id"]').on('change',function(){
            
            var category_id= $(this).val();
            if(category_id){
                //alert("going well");
                $.ajax({
                    
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType:"json",
                  
                    success:function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                          $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.sub_category_name_en+ '</option>');
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