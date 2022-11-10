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
				  <h3 class="box-title">Update Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('category.update', $category->id)}}" >
           @csrf

           <input type="hidden" name="id" value="{{ $category->id }}">
             <div class="row">
               <div class="col-8">	
               
                    <div class="form-group">
                       <h5>Category Name English <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" value="{{ $category->category_name_en }}"  name="category_name_en" class="form-control"  > 
						   @error('category_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Category Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" value="{{ $category->category_name_hin }}" name="category_name_hin" class="form-control"   > 
						   @error('category_name_hin')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Category Icon <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input value="{{ $category->category_icon }}" type="text" name="category_icon" class="form-control"   > 
						   @error('category_icon')
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