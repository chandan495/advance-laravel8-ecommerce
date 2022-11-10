<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.view_coupon',compact('coupons'));
    }
    public function CouponStore(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ],[
            'coupon_name.required' => 'Enter Coupon Name',
            'coupon_discount.required' => 'Enter Coupon Discount',
            'coupon_validity.required' => 'Enter Validity',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function CouponEdit($id){
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon',compact('coupon'));
    }
    public function CouponUpdate(Request $request){
        $couponid = $request->id;
        Coupon::findOrFail($couponid)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' =>   $request->coupon_validity,
        ]);

        $notification = array(
            'message' => 'Coupon has been Updated Successfully',
            'alert_type' => 'info'
        );
        return redirect()->route('manage-coupon')->with($notification);
    }
    public function CouponDelete($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon has been Deleted Successfully',
            'alert_type' => 'danger'
        );
        return redirect()->back()->with($notification);

    }
}
