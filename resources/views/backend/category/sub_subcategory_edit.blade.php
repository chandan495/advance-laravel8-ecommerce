@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			 

			
            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Sub Sub Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('subsubcategory.update')}}" >
           @csrf
           <input type="hidden" name="id" value="{{ $subsubcategories->id }}" >
             <div class="row">
               <div class="col-8">	
               
                    <div class="form-group">
                       <h5>Category English <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <select name="category_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Category</option>
								@foreach($categories as $category)
								<option value="{{ $category->id }}" {{ $category->id == $subsubcategories->category_id ? 'selected':''}}>{{ $category->category_name_en }}</option>

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
								@foreach($subcategories as $subsubcategory)
								<option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == $subsubcategories->subcategory_id ? 'selected':''}}>{{ $subsubcategory->sub_category_name_en }}</option>

								@endforeach
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
                           <input type="text"  name="subsub_category_name_en" class="form-control" value="{{ $subsubcategories->subsub_category_name_en }}"  > 
						   @error('subsub_category_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub->Sub Category Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="subsub_category_name_hin" class="form-control"  value="{{ $subsubcategories->subsub_category_name_hin }}" > 
						   @error('subsub_category_name_hin')
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
 
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change',function(){
            
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