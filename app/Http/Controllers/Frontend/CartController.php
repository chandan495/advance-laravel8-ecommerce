<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' =>1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    
                    ]
                ]);

                return response()->json(['success'=>'Successfully added to your Cart']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' =>1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    
                    ]
                ]);
                return response()->json(['success'=>'Successfully added to your Cart']);
        }
    }
    public function AddMiniCart(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => $cartTotal,

    	));
    //    $carts = Cart::content();
    // 	$cartQty = Cart::count();
    // 	$cartTotal = Cart::total();

    // 	return response()->json(array(
    // 		'carts' => $carts,
    // 		'cartQty' => $cartQty,
    // 		'cartTotal' => round($cartTotal),

    // 	));
    }
    public function RemoveMiniCart($rowId){
    	Cart::remove($rowId);
    	return response()->json(['success' => 'Product Remove from Cart']);

    } // end mehtod 

    public function AddToWishlistcart(Request $request, $product_id){
            if(Auth::check()){
                $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

                if(!$exists){
                    Wishlist::insert([
                        'user_id' => Auth::id(),
                        'product_id' => $product_id,
                        'created_at' => Carbon::now(),
                    ]);
                    return response()->json(['success' => 'Product has been added to wishlist successfully']);
                }
                else{
                    return response()->json(['error' => 'Already Added in your Wishlist']);
                }
                
            }
            else{
                return response()->json(['error' => 'At First login your Account']);
            }
    }
    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if($coupon){

            Session::put('coupon',[

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),

            ]);
            return response()->json(array(
                'success' => 'Applied to coupon'
            ));
        }
        else{

            return response()->json(['error' => 'Something went worng try again']);
        }
    }
    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }
        else{
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }
    
}
