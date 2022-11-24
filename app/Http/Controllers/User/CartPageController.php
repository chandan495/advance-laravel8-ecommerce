<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

class CartPageController extends Controller
{
    public function UserMycart(){
        return view('frontend.wishlist.view_cart');
    }

    // public function GetMycartProduct(){
    //     $carts = Cart::content();
    // 	$cartQty = Cart::count();
    // 	$cartTotal = Cart::total();

    // 	return response()->json(array(
    // 		'carts' => $carts,
    // 		'cartQty' => $cartQty,
    // 		'cartTotal' => $cartTotal,

    //     ));
    public function GetCartProduct(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	));
    }
    public function CartIncreament($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

        //    Session::put('coupon',[
        //         'coupon_name' => $coupon->coupon_name,
        //         'coupon_discount' => $coupon->coupon_discount,
        //         'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
        //         'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
        //     ]);
        $total = (int)str_replace(',','',Cart::total());
        Session::put('coupon', [
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round($total * $coupon->coupon_discount/100),
            'total_amount' => round($total - $total * $coupon->coupon_discount/100)
            ]);
        }

        return response()->json(['success' => 'Cart Product has been updated successfully']);
    }
    public function CartDecreament($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

        //    Session::put('coupon',[
        //         'coupon_name' => $coupon->coupon_name,
        //         'coupon_discount' => $coupon->coupon_discount,
        //         'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
        //         'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
        //     ]);
        $total = (int)str_replace(',','',Cart::total());
        Session::put('coupon', [
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round($total * $coupon->coupon_discount/100),
            'total_amount' => round($total - $total * $coupon->coupon_discount/100)
            ]);
        }
        
        return response()->json([
            'success' => 'Cart Product has been updated successfully Thanks'
        ]);
    }
}
