<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function UserWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishlistProduct(){
        // $wishlist = Wishlist::with('product')->where('user_id', Auth::id)->latest()->get();
        // return response()->json($wishlist);
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
		return response()->json($wishlist);
    }
    public function RemoveWishlist($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success'=>'Successfuly removed from your wishlist']);
    }
}
