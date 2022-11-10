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
				  <h3 class="box-title">Slider List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Slider Image</th>
								<th>Title</th>
								<th>Description</th>
                                <th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($sliders as $item)
							<tr>
								<td><img src="{{ asset($item->slider_img) }}" style="width:70px; height:50px;border:2px solid #fff; padding:5px;"/></td>
								<td>
                                @if($item->title ==Null)
                        
								<span class="badge badge-pill badge-danger">No Title</span>
								@else
								{{ $item->title }}
								@endif
                                </td>
								<td>{{ $item->description }}</td>
                                <td>@if($item->status == 1)
								<span class="badge badge-pill badge-success">Active</span>
								@else
								<span class="badge badge-pill badge-danger">InActive</span>
								@endif</td>
								<td style="width:30%">
                                <a title="Edit Data"  class="btn btn-info" href="{{ route('edit.slider',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('slider.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a>
                                @if($item->status == 1)
								<a title="Active Now"  class="btn btn-danger" href="{{ route('slider.inactive',$item->id) }}"><i class="fa fa-arrow-down"></i></a>
								@else
								<a title="In Active"  class="btn btn-success" href="{{ route('slider.active',$item->id) }}"><i class="fa fa-arrow-up"></i></a>
								@endif</td>
								
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
				  <h3 class="box-title">Add Slider </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('slider.store')}}" enctype="multipart/form-data">
           @csrf
             <div class="row">
               <div class="col-12">	
               
                    <div class="form-group">
                       <h5>Slider Title <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="title" class="form-control"  > 
						   @error('title')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Slider Description <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="description" class="form-control"   > 
						   @error('description')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Slider Image <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="file" name="slider_img" class="form-control"   > 
						   @error('slider_img')
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