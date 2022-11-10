@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			 

			
            <div class="col-10">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Slider </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('slider.update', $slider->id)}}" enctype="multipart/form-data">
           @csrf
             <div class="row">
               <div class="col-12">	
               <input type="hidden" name="id" value="{{ $slider->id }}">
               <input type="hidden" name="old_image" value="{{ $slider->slider_img }}" >
                    <div class="form-group">
                       <h5>Title<span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="title" class="form-control" value="{{ $slider->title}}" > 
						   @error('title')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Description <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="description" class="form-control"  value="{{ $slider->description}}" > 
						   @error('description')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Slider Image <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="file" name="slider_img" class="form-control"   >

                     
						   @error('brand_image')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div><br/>
                           <img src="{{ asset($slider->slider_img) }}" style="height:120px; width:200px;">
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