<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        return response()->json(['success' => 'Cart Product has been updated successfully']);
    }
    public function CartDecreament($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json([
            'success' => 'Cart Product has been updated successfully Thanks'
        ]);
    }
}
