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
				  <h3 class="box-title">Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category Icon</th>
								<th>Category English</th>
								<th>Category Hindi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($category as $item)
							<tr>
								<td><i style="font-size:40px;color:yellow;" class="{{ $item->category_icon }}"></i></td>
								<td>{{ $item->category_name_en }}</td>
                                <td>{{ $item->category_name_hin }}</td>
								<td><a title="Edit Data"  class="btn btn-info" href="{{ route('category.edit',$item->id) }}"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a title="Delete Data" class="btn btn-danger" href="{{ route('category.delete',$item->id) }}" id="delete" ><i class="fa fa-trash"></i></a></td>
								
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
				  <h3 class="box-title">Add Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                <form method="post" action="{{ route('category.store')}}" >
           @csrf
             <div class="row">
               <div class="col-12">	
               
                    <div class="form-group">
                       <h5>Category Name English <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="category_name_en" class="form-control"  > 
						   @error('category_name_en')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Category Name Hindi <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text"  name="category_name_hin" class="form-control"   > 
						   @error('category_name_hin')
							<span class="text-danger">{{ $message }}</span>	
						   @enderror
						   </div>
                   </div>

                   <div class="form-group">
                       <h5>Category Icon <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="text" name="category_icon" class="form-control"   > 
						   @error('category_icon')
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