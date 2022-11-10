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
				  <h3 class="box-title">Edit Sub Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('subcategory.update')}}" >
           @csrf
             <div class="row">
               <div class="col-8">	
               
                    <div class="form-group">
                       <h5>Category English <span class="text-danger">*</span></h5>
                       <input type="hidden" name="id" value="{{ $subcategory->id }}"/>
                       <div class="controls">
                            <select name="category_id" class="form-control">
                                <option value="" selected=""  disabled="">Select Category</option>
								@foreach($categories as $category)
								<option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? "selected":"" }}>{{ $category->category_name_en }}</option>

								@endforeach
                            </select>
                           <!-- <input type="text"  name="category_id" class="form-control"  >  -->
						   @error('category_id')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="sub_category_name_en" class="form-control" value="{{ $subcategory->sub_category_name_en}}"  > 
						   @error('sub_category_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Sub Category Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="sub_category_name_hin" class="form-control"  value="{{ $subcategory->sub_category_name_hin }}"  > 
						   @error('sub_category_name_hin')
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