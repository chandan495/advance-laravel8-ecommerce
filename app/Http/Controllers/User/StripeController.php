<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){

      $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'post_code' => $request->post_code,
        'notes' => $request->notes,
 
        'payment_type' => 'Stripe',
        'payment_method' => 'Stripe',
        'payment_type' => $request->payment_type,
        'transaction_id' => $request->transaction_id,
        'currency' => $request->currency,
        'amount' => $request->total_amount,
        'order_number' => $request->order_number,
 
        'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'),
        'status' => 'Pending',
        'created_at' => Carbon::now(),	 
 
      ]);

      // Start Send Email 
     $invoice = Order::findOrFail($order_id);
     $data = [
       'invoice_no' => $invoice->invoice_no,
       'amount' => $invoice->amount,
       'name' => $invoice->name,
         'email' => $invoice->email,
     ];

     Mail::to($request->email)->send(new OrderMail($data));

   // End Send Email 
 
      $carts = Cart::content();
      foreach ($carts as $cart) {
        OrderItem::insert([
          'order_id' => $order_id, 
          'product_id' => $cart->id,
          'color' => $cart->options->color,
          'size' => $cart->options->size,
          'qty' => $cart->qty,
          'price' => $cart->price,
          'created_at' => Carbon::now(),
 
        ]);
      }
      if (Session::has('coupon')) {
        Session::forget('coupon');
      }
 
      Cart::destroy();
 
      $notification = array(
       'message' => 'Your Order Place Successfully',
       'alert-type' => 'success'
     );
 
     return redirect()->route('dashboard')->with($notification);
      // \Stripe\Stripe::setApiKey('sk_test_51M8oq8SB1S7K6NZ75YYJuRWWSoxwQpKpScUrnnusxRX9cvoBJm72JGxOTnBcVXkDUsRyrFZrgFN8k4wHgEeN7LqP00qIWhwfaO');
      // $token = $_POST['stripeToken'];
      // $charge = \Stripe\PaymentIntent::create([
      //   'amount' => 999*100,
      //   'currency' => 'usd',
      //   'description' => 'Easy Online Store',
      //   'source' => $token,
      //   'metadata' => ['order_id' => '6735'],
      // ]);
      // $intent = $charge->client_secret;

      // return view('frontend.payment.stripe',compact('intent'));
      // dd($charge);
    }
}
