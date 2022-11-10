@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Product Details </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
	
					  <div class="row">
	<div class="col-12">	


		<div class="row"> <!-- start 1st row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5>Brand Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="brand_id" class="form-control" disabled >
			<option value="" selected="" disabled="">Select Brand</option>
			@foreach($brands as $brand)
 <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>	
			@endforeach
		</select>
		@error('brand_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
	<h5>Category Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="category_id" class="form-control" disabled >
			<option value="" selected="" disabled="">Select Category</option>
			@foreach($categories as $category)
 <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>	
			@endforeach
		</select>
		@error('category_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
	<h5>SubCategory Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="subcategory_id" class="form-control" disabled >
			<option value="" selected="" disabled="">Select SubCategory</option>
            @foreach($subcategories as $sub)
 <option value="{{ $sub->id }}" {{ $sub->id == $products->subcategory_id ? 'selected' : '' }}>{{ $sub->sub_category_name_en }}</option>	
			@endforeach
		</select>
		@error('subcategory_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 1st row  -->
		<div style="clear:both">&nbsp;</div>
		<div class="row"> <!-- start 2nd row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5>SubSubCategory Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="subsubcategory_id" class="form-control" disabled >
			<option value="" selected="" disabled="">Select SubSubCategory</option>
            @foreach($subsubcategories as $subsub)
 <option value="{{ $subsub->id }}" {{ $subsub->id == $products->subsubcategory_id ? 'selected' : '' }}>{{ $subsub->subsub_category_name_en }}</option>	
			@endforeach
		</select>
		@error('subsubcategory_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5>Product Name En <span class="text-danger">*</span></h5>
			<div class="controls">
				<input disabled type="text" value="{{ $products->product_name_en }}" name="product_name_en" class="form-control" required>
     @error('product_name_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">


		<div class="form-group">
				
			<h5>Product Name Hin <span class="text-danger">*</span></h5>
			<div class="controls">
				<input disabled type="text" value="{{ $products->product_name_hin }}" name="product_name_hin" class="form-control" required>
     @error('product_name_hin') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
			  
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 2nd row  -->

		<div style="clear:both">&nbsp;</div>

<div class="row"> <!-- start 3RD row  -->
			<div class="col-md-4">

	  <div class="form-group">
			<h5>Product Code <span class="text-danger">*</span></h5>
			<div class="controls">
				<input disabled type="text" value="{{ $products->product_code }}" name="product_code" class="form-control" required >
     @error('product_code') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5>Product Quantity <span class="text-danger">*</span></h5>
			<div class="controls">
				<input disabled type="text" value="{{ $products->product_qty }}" name="product_qty" class="form-control" required>
     @error('product_qty') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 	  </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
			<h5>Product Tags En <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="product_tags_en" class="form-control" value="{{ $products->product_tags_en }}" data-role="tagsinput" required>
     @error('product_tags_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 3RD row  -->



		<div style="clear:both">&nbsp;</div>


<div class="row"> <!-- start 4th row  -->
			<div class="col-md-4">

	    <div class="form-group">
			<h5>Product Tags Hin <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input type="text" disabled name="product_tags_hin" class="form-control" value="{{ $products->product_tags_hin }}" data-role="tagsinput" required>
     @error('product_tags_hin') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
			<h5>Product Size En <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="product_size_en" class="form-control" value="{{ $products->product_size_en }}" data-role="tagsinput" required>
     @error('product_size_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
			<h5>Product Size Hin <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="product_size_hin" class="form-control" value="{{ $products->product_size_hin }}" data-role="tagsinput" required>
     @error('product_size_hin') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 4th row  -->
		<div style="clear:both">&nbsp;</div>

		<div class="row"> <!-- start 5th row  -->
			<div class="col-md-6">

	    <div class="form-group">
			<h5>Product Color Eng <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="product_color_en" class="form-control" value="{{ $products->product_color_en }}" data-role="tagsinput" required>
     @error('product_color_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

			<div class="col-md-6">

				 <div class="form-group">
			<h5>Product Color Hin <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="product_color_hin" class="form-control" value="{{ $products->product_color_hin }}" data-role="tagsinput" required>
     @error('product_color_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->


			

		</div> <!-- end 5th row  -->
		<div style="clear:both">&nbsp;</div>
		<div class="row"> <!-- start 6th row  -->
			<div class="col-md-6">

	    <div class="form-group">
			<h5>Product Discount Price <span class="text-danger">*</span></h5>
			<div class="controls">
	 <input disabled type="text" name="discount_price" value="{{ $products->discount_price }}"  class="form-control" value="" required>
     @error('discount_price') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
	 		 </div>
		</div>

			</div> <!-- end col md 4 -->

		

            <div class="col-md-6">

<div class="form-group">
<h5>Product Selling Price <span class="text-danger">*</span></h5>
<div class="controls">
<input disabled type="text" name="selling_price" class="form-control" value="{{ $products->selling_price }}"  required>
@error('selling_price') 
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>

</div> <!-- end col md 4 -->

			


			
			<div style="clear:both">&nbsp;</div>
		</div> <!-- end 6th row  -->
		<div class="row"> <!-- start 7th row  -->
			<div class="col-md-6">

			<div class="form-group">
			<h5>Product Short Description Eng <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea disabled name="short_descp_en" id="text-area" class="form-control" required >{{ $products->short_descp_en }}</textarea>
				@error('short_descp_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
			</div>
		</div>

			</div> <!-- end col md 6 -->

			<div class="col-md-6">

			<div class="form-group">
			<h5>Product Short Description Hin <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea disabled name="short_descp_hin" id="text-area" class="form-control" required placeholder="Textarea text">{{ $products->short_descp_hin }}</textarea>
				@error('short_descp_hin') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
			</div>
		</div>

			</div> <!-- end col md 6 -->


			

		</div> <!-- end 6th row  -->
		<div style="clear:both">&nbsp;</div>
		<div class="row"> <!-- start 7th row  -->
			<div class="col-md-6">

			<div class="form-group">
			<h5>Product Long Description Eng <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea disabled name="long_descp_en" id="editor1" class="form-control" required placeholder="Textarea text">{{ $products->long_descp_en }}</textarea>
				@error('long_descp_en') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
			</div>
		</div>

			</div> <!-- end col md 6 -->

			<div class="col-md-6">

			<div class="form-group">
			<h5>Product Long Description Hin <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea disabled name="long_descp_hin" id="editor2" class="form-control" required placeholder="Textarea text">{{ $products->long_descp_hin }}</textarea>
				@error('long_descp_hin') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
			</div>
		</div>

			</div> <!-- end col md 6 -->


			

		</div> <!-- end 7th row  -->
		<div style="clear:both">&nbsp;</div>
		<hr>
		<div class="row"> <!-- start 8th row  -->
			<div class="col-md-6">

			<div class="form-group">
				
				<div class="controls">
					<fieldset>
						<input disabled type="checkbox"  id="checkbox_2" required value="1" name="hot_deals" {{ $products->hot_deals == 1 ? 'checked' : '' }}>
						<label for="checkbox_2">Hot Deals</label>
					</fieldset>
					<fieldset>
						<input disabled type="checkbox" id="checkbox_3" value="1" name="featured" {{ $products->featured == 1 ? 'checked' : '' }}>
						<label for="checkbox_3">Feature</label>
					</fieldset>
				</div>
			</div>

			</div> <!-- end col md 6 -->

			<div class="col-md-6">

			<div class="form-group">
				
				<div class="controls">
					<fieldset>
						<input disabled type="checkbox" id="checkbox_4" required value="1" name="special_offer" {{ $products->special_offer == 1 ? 'checked' : '' }} >
						<label for="checkbox_4">Special Offer</label>
					</fieldset>
					<fieldset>
						<input disabled type="checkbox" id="checkbox_5" value="1" name="special_deals" {{ $products->special_deals == 1 ? 'checked' : '' }}>
						<label for="checkbox_5">Special Deals</label>
					</fieldset>
				</div>
			</div>

			</div> <!-- end col md 6 -->

			


			

		</div> <!-- end 8th row  -->
		<div style="clear:both">&nbsp;</div>
		

						<!-- <div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
						</div> -->
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
		<section class="content">
			<div class="row">
			<div class="col-md-12 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Product Multiple Image Update</strong></h4>
				  </div>
				  <form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
				  @csrf
				  <div class="row row-sm">
				  @foreach($multipleimage as $img)
				  	<div class="col-md-3">
					  
					  <div class="card">
  <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height:350px; width:100%;">
  <div class="card-body">
    <!-- <h5 class="card-title"><a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></h5> -->
    <p class="card-text">
	<div class="form-group">
		<!-- <label class="form-control-label">Change Image<span class="tx-danger">*</span></lable>
		<input type="file" name="multi_img[{{$img->id }}]" class="form-control"> -->
	</div>
	</p>
  </div>
</div>

					  </div>
					@endforeach	  
				  </div>
				  <!-- <div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
						</div> -->
				  </form>
				</div>
			  </div>
			</div>
			
		</div>

		</section>		


		<section class="content">
			<div class="row">
			<div class="col-md-12 col-12">
				<div class="box box-bordered border-primary">
				  <div class="box-header with-border">
					<h4 class="box-title"><strong>Product Thumbnail Image Update</strong></h4>
				  </div>
				  <form method="post" action="{{ route('update-product-thumbnail') }}" enctype="multipart/form-data">
				  @csrf
				  <div class="row row-sm">
				 <input type="hidden" name="id" value="{{ $products->id }}" />
				 <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}" />
				  	<div class="col-md-3">
					  
					  <div class="card">
  <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top" style="height:350px; width:100%;">
  <div class="card-body">
    
    <p class="card-text">
	<!-- <div class="form-group">
		<label class="form-control-label">Change Image<span class="tx-danger">*</span></lable>
		<input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)" required>
		<img src="" id="mainThumb" >
	</div> -->
	</p>
	<img src="" id="mainThumb" >
  </div>
</div>

					  </div>
				  
				  </div>
				  <!-- <div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
						</div> -->
				  </form>
				</div>
			  </div>
			</div>
			
		</div>

		</section>


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
						$('select[name="subsubcategory_id"]').html('');
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

		$('select[name="subcategory_id"]').on('change',function(){
            
            var subcategory_id= $(this).val();
            if(subcategory_id){
                //alert("going well");
                $.ajax({
                    
                    url: "{{ url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type: "GET",
                    dataType:"json",
                  
                    success:function(data){
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                          $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsub_category_name_en+ '</option>');
                        });
                        
                        
                    },
                });
            }else{
                alert('danger');
            }
        });

    });
</script>

<script type="text/javascript">
	function mainThumbUrl(input){
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThumb').attr('src',e.target.result).width(80).height(50);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img style="border:2px solid #c9c9c9;margin:2px;"/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(50); //create image element 
                      $('#previewimg').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
@endsection  