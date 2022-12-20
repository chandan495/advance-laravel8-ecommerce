<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

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
        $cartTotal = Cart::total();
        
        if($request->payment_method == 'Stripe'){

            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'];
            }else{
                $total_amount = round(Cart::total());
            }

            // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51M8oq8SB1S7K6NZ75YYJuRWWSoxwQpKpScUrnnusxRX9cvoBJm72JGxOTnBcVXkDUsRyrFZrgFN8k4wHgEeN7LqP00qIWhwfaO');
        		
		$amount = $total_amount;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment doing chandan',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From Chandan kumar',
            'payment_method_types' => ['card'],
            'metadata' => ['order_id' => uniqid()],
		]);
        $intent = $payment_intent->client_secret;
        $payment_type = 'Card';
        $transaction_id = $payment_intent->id;
        $currency = $payment_intent->currency;
        $order_number = $payment_intent->metadata->order_id;
        
            return view('frontend.payment.stripe',compact('data','cartTotal','intent','payment_type','transaction_id','currency','order_number','total_amount'));
        }
        elseif($request->payment_method == 'card'){
            return view('frontend.payment.card',compact('data'));
        }
        else{
            return view('frontend.payment.cash',compact('data'));
        }
    }
}
