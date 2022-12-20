<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
<script src="https://js.stripe.com/v3/"></script>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{ asset('frontend/assets/js/scripts.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert_type', 'info') }}"
switch(type){
  case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.info(" {{ Session::get('message') }} ");
    break;

}
@endif
</script>
<!-- add to cart modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodel">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-md-4">
        <div class="card" style="width: 18rem;">
  <img src=" " class="card-img-top" alt="..." style="width:250px;" id="pimage">
</div>
        </div>
        <div class="col-md-4">
        <ul class="list-group">
  <li class="list-group-item">Product Price: Rs.<strong class="text-danger" id="pprice"></strong>&nbsp;<del id="poldprice"></del></li>
  <li class="list-group-item">Product Code:  <strong id="pcode"></strong></li>
  <li class="list-group-item">Category:  <strong id="pcat"></strong></li>
  <li class="list-group-item">Brand:  <strong id="pbrand"></strong></li>
  <li class="list-group-item">Stock:  <strong class="text-success" id="avi"></strong><strong class="text-danger" id="stock"></strong></li>
</ul>
        </div>
        <div class="col-md-4">
        <div class="form-group">
    <label for="color1">Choose Color</label>
    <select class="form-control" id="color1" name="color">
      
     
    </select>
  </div>
  <div class="form-group" id="sizeArea">
    <label for="size1">Choose Size</label>
    <select class="form-control" id="size1" name="size">
     
      
    </select>
  </div>
  <div class="form-group">
    <label for="qty">Quantity</label>
    <input type="number" class="form-control" id="qty" min="1">
  </div>
  <input type="hidden" id="product_id">
  <button type="submit" class="btn btn-primary mb-2" onclick="AddToCart()">Add To Cart</button>
        </div>
       </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

 function productView(id){
   //alert(id);
   $.ajax({
     type: 'GET',
     url: '/product/view/modal/'+id,
     dataType: 'json',
     success:function(data){
      //  console.log(data)
      $('#pname').text(data.product.product_name_en);
      //$('#pprice').text(data.product.selling_price);
      $('#pcode').text(data.product.product_code);
      $('#pcat').text(data.product.category.category_name_en);
      $('#pbrand').text(data.product.brand.brand_name_en);
      $('#pqty').text(data.product.product_qty);
      $('#pimage').attr('src','/'+data.product.product_thumbnail);
      $('#product_id').val(id);
      $('#qty').val(1);

      //product name
      if(data.product.discount_price == null){
        $('#pprice').text('');
        $('#poldprice').text('');
        $('#pprice').text(data.product.selling_price);
      }
      else{
        
        $('#pprice').text(data.product.discount_price);
        $('#poldprice').text(data.product.selling_price);
      }

      //stock option
      if(data.product.product_qty > 0){
        $('#stock').text('');
        $('#avi').text('');
        $('#avi').text('Aviable');
      }
      else{
        $('#stock').text('');
        $('#avi').text('');
        $('#stock').text('Out of Stock');
      }

      $('select[name="color"]').empty();  
      $.each(data.color, function(key, value){
        $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>')
      })

      $('select[name="size"]').empty();  
      $.each(data.size, function(key, value){
        $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>')

        if (data.size == "") {
            $('#sizeArea').hide();
        }else{
            $('#sizeArea').show();
        }

      })




     }
   })
 } 


 // Add to cart

 function AddToCart(){
   var product_name = $('#pname').text();
   var id = $('#product_id').val();
   var color = $('#color1 option:selected').text();
   var size = $('#size1 option:selected').text();
   var quantity = $('#qty').val();

   $.ajax({
     type:"POST",
     dataType:"json",

     data:{
       color:color,size:size,quantity:quantity,product_name:product_name
     },
     url:"/cart/data/store/"+id,
     success:function(data){
      MiniCart();
       $('#closemodel').click();
       
       //console.log(data);
       
      //  const Toast = Swal.mixin({
      //    toast: true,
      //     position: 'top-end',
      //     icon: 'success',
      //     title: 'Your work has been saved',
      //     showConfirmButton: false,
      //     timer: 3000
      //   })
      //   if($.isEmptyObject(data.error)){
      //       Toast:fire({
      //         type:'success',
      //         title: data.success
      //       })
      //   }
      //   else{
      //     Toast:fire({
      //         type:'success',
      //         title: data.error
      //       })
      //   }
        // Start Message 
        const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
     }
   })
 }


</script>
<script type="text/javascript">
function MiniCart(){
  $.ajax({
    type: 'GET',
    url:'/product/mini/cart/',
    dataType:'json',
    success:function(response){
      //console.log(response);
      $('span[id="cartSubTotal"]').text(response.cartTotal);
      $('#cartQty').text(response.cartQty);
      var minicart = "";
      $.each(response.carts, function(key, value){

        minicart +=`<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                      <div class="price">${value.price} * ${value.qty} </div>
                    </div>
                    <div class="col-xs-1 action">
                     <button type="submit" id="${value.rowId}" onclick="minicartRemove(this.id)"><i class="fa fa-trash"></i></button> 
                     </div>
                  </div>
                </div><div class="clearfix"></div>
                <hr>`
          });
      $('#minicart').html(minicart);
    }
  })
}
MiniCart();

//mini cart remove
function minicartRemove(rowId){
  $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
              CalFiledCalculation();
              MiniCart();
              cart();
              $('#couponcalfield1').show();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
}

//end mini cart remove
</script>

<script type="text/javascript">
function addToWhistlist(product_id){
    $.ajax({
      type:'POST',
      dataType:'json',
      url:'/add-to-wishlist/'+product_id,
      success:function(data){
        // Start Message 
        const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
      }
    })
}
</script>

<!-- <script type="text/javascript">
function Wishtlist(){
  $.ajax({
    type: 'GET',
    url:'/get-wishlist-product',
    dataType:'json',
    success:function(response){
      console.log(response);
      // $('span[id="cartSubTotal"]').text(response.cartTotal);
      // $('#cartQty').text(response.cartQty);
      var row = "";
      $.each(response, function(key, value){

        row +=`	<tr>
					<td class="col-md-2"><img src="/${value.product.product_thumb}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
						<div class="rating">
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star non-rate"></i>
							<span class="review">( 06 Reviews )</span>
						</div>
						<div class="price">
            ${value.product.discount_price == null
              ? `${value.product.selling_price}`
              : `${value.product.discount_price} <span>$ ${value.product.selling_price}</span>`

            }
						
						</div>
					</td>
					<td class="col-md-2">
						<a href="#" class="btn-upper btn btn-primary">Add to cart</a>
					</td>
					<td class="col-md-1 close-btn">
						<a href="#" class=""><i class="fa fa-times"></i></a>
					</td>
				</tr>`
          });
      $('#wishtlist').html(row);
    }
  })
}
Wishtlist();
</script> -->
<script type="text/javascript">
     function wishlist(){
        $.ajax({
            type: 'GET',
            url: '/user/get-wishlist-product',
            dataType:'json',
            success:function(response){
                var rows = ""
                $.each(response, function(key,value){
                    rows += `<tr>
                    <td class="col-md-2"><img src="/${value.product.product_thumbnail} " alt="imga"></td>
                    <td class="col-md-7">
                        <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
                         
                        <div class="price">
                        ${value.product.discount_price == null
                            ? `${value.product.selling_price}`
                            :
                            `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                        }
                            
                        </div>
                    </td>
        <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
        </td>
        <td class="col-md-1 close-btn">
            <button type="submit" id="${value.id}" class="" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
        </td>
                </tr>`
        });
                
                $('#wishlist').html(rows);
            }
        })
     }
 wishlist();

 //Wishlist remove
function wishlistRemove(id){
  $.ajax({
            type: 'GET',
            url: '/user/wishlist-remove/'+id,
            dataType:'json',
            success:function(data){
              wishlist();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
}

//end mini cart remove
 </script> 

<script type="text/javascript">
  //    function Mycartpage(){
  //       $.ajax({
  //           type: 'GET',
  //           url: '/user/get-mycart-product',
  //           dataType:'json',
  //           success:function(response){
  //             console.log(response);
  //               var rows = ""
  //               $.each(response.carts, function(key,value){
  //                   rows += `<tr>
  //                   <td class="col-md-2"><img src="/${value.option.image} " alt="imga"></td>
  //                   <td class="col-md-7">
  //                       <div class="product-name"><a href="#">${value.name}</a></div>
                         
  //                       <div class="price">
  //                       ${value.price}
                            
  //                       </div>
  //                   </td>
  //       <td class="col-md-2">
           
  //       </td>
  //       <td class="col-md-1 close-btn">
  //           <button type="submit" id="${value.id}" class="" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
  //       </td>
  //               </tr>`
  //       });
                
  //               $('#mycart').html(rows);
  //           }
  //       })
  //    }
  //  Mycartpage();

  function cart(){
        $.ajax({
            type: 'GET',
            url: '/user/get-mycart-product',
            dataType:'json',
            success:function(response){
    var rows = ""
    $.each(response.carts, function(key,value){
        rows += `<tr>
        <td class="col-md-2"><img src="/${value.options.image} " alt="imga" style="width:100px;height:100px;"></td>
        
        <td class="col-md-3">
            <div class="product-name"><a href="#">${value.name}</a></div>
             
            <div class="price"> 
                            ${value.price}
                        </div>
                    </td>
                    <td class="col-md-2">
            <strong>${value.options.color}</strong>
                    </td>
                    <td class="col-md-2">
            <strong>${value.options.size}</strong>
                    </td>
                    <td class="col-md-2">
                    ${value.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartdecrease(this.id)">-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            }
                    

                    
            <input type="text" name="qty" value="${value.qty}" style="width:25px;" disabled/>
            <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartincrease(this.id)">+</button>
                    </td>
                    <td class="col-md-2">
            <strong>$${value.subtotal}</strong>
                    </td>
        <td class="col-md-1 close-btn">
        <button type="submit" id="${value.rowId}" onclick="minicartRemove(this.id)"><i class="fa fa-trash"></i></button> 
        </td>
                </tr>`
        });
                
                $('#cartPage').html(rows);
            }
        })
     }
 cart();


//  //Wishlist remove
// function wishlistRemove(id){
//   $.ajax({
//             type: 'GET',
//             url: '/user/wishlist-remove/'+id,
//             dataType:'json',
//             success:function(data){
//               wishlist();
//              // Start Message 
//                 const Toast = Swal.mixin({
//                       toast: true,
//                       position: 'top-end',
//                       icon: 'success',
//                       showConfirmButton: false,
//                       timer: 3000
//                     })
//                 if ($.isEmptyObject(data.error)) {
//                     Toast.fire({
//                         type: 'success',
//                         icon: 'success',
//                         title: data.success
//                     })
//                 }else{
//                     Toast.fire({
//                         type: 'error',
//                         icon: 'error',
//                         title: data.error
//                     })
//                 }
//                 // End Message 
//             }
//         });
// }

//end mini cart remove

//--------Cart Increament ------------//

function cartincrease(rowId){
  $.ajax({
    type:'GET',
    url:'/cart-increament/'+rowId,
    dataType:'json',
    success:function(data){
      CalFiledCalculation();
      MiniCart();
      cart();
      // Start Message 
      const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
    }
  });
}

//end cart increamenet

function cartdecrease(rowId){
  $.ajax({
    type:'GET',
    url:'/cart-decrement/'+rowId,
    dataType:'json',
    success:function(data){
      CalFiledCalculation();
      MiniCart();
      cart();
      // Start Message 
      const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
    }
  });
}

//end cart increamenet

 </script> 

<script>
// // Start Message 
// const Toast = Swal.mixin({
//                       toast: true,
//                       position: 'top-end',
//                       icon: 'success',
//                       showConfirmButton: false,
//                       timer: 3000
//                     })
//                 if ($.isEmptyObject(data.error)) {
//                     Toast.fire({
//                         type: 'success',
//                         icon: 'success',
//                         title: data.success
//                     })
//                 }else{
//                     Toast.fire({
//                         type: 'error',
//                         icon: 'error',
//                         title: data.error
//                     })
//                 }
//                 // End Message 
function applyCoupon(){
 //alert("tesing");
  var coupon_name = $('#coupon_name').val();
 
    $.ajax({
      
        type: 'POST',
        dataType: 'json',
        data: {coupon_name:coupon_name},
        url: "{{ url('/coupon-apply') }}",
        success:function(data){
          CalFiledCalculation();
          if(data.validity == true){
            $('#couponcalfield1').hide();
          }
          
          // Start Message 
      const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
        }
      })

}

function CalFiledCalculation(){
  $.ajax({
    type:'get',
    url:"{{ url('/coupon-calculation') }}",
    dataType:'json',
    success:function(data){
      
        if(data.total){
          $('#couponcalfield').html(
            `<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$ ${data.total}</span>
					</div>
					<div class="cart-grand-total" style="color:#5cb85c;font-weight:bold;">
						Grand Total<span class="inner-left-md">$ ${data.total}</span>
					</div>
				</th>
			</tr>`
          )
        }
        else{
          $('#couponcalfield').html(
            `<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
					</div>
          <div class="cart-sub-total">
						Applied Coupon<span class="inner-left-md"> ${data.coupon_name}</span>
            <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
					</div>
          <div class="cart-sub-total">
						Total Discount<span class="inner-left-md">$ ${data.discount_amount}</span>
					</div>
					<div class="cart-grand-total" style="color:#5cb85c;font-weight:bold;">
						Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
					</div>
				</th>
			</tr>`)
        }
    }
  });
}
CalFiledCalculation();
</script>

<script>
function couponRemove(){
  $.ajax({
    type:'get',
    url:"{{ url('/coupon-remove') }}",
    dataType:'json',
    success:function(data){
      CalFiledCalculation();
      $('#couponcalfield1').show();
      $('#coupon_name').val('');
       // Start Message 
       const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message 
    }
  });
}
//couponRemove();
</script>
</body>
</html>