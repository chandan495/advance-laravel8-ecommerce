<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;

class CheckoutController extends Controller
{
    public function GetDistrictAjax($division_id){
        $ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($ship);
    }
    public function GetStateAjax($district_id){
        $ship = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
        return json_encode($ship);
    }
    public function CheckoutStore(Request $request){
        //dd($request->all());

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->shipping_name;
        $data['notes'] = $request->shipping_name;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;


        if($request->payment_method == 'Stripe'){
            return view('frontend.payment.stripe',compact('data'));
        }
        elseif($request->payment_method == 'card'){
            return view('frontend.payment.card',compact('data'));
        }
        else{
            return view('frontend.payment.cash',compact('data'));
        }
    }
}
