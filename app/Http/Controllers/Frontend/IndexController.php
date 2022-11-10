<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotdeal = Product::where('hot_deals', 1)->where('discount_price','!=',NULL)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_0 = Brand::skip(8)->first();
        $skip_brand_product_0 = Product::where('status',1)->where('brand_id',$skip_brand_0->id)->orderBy('id','DESC')->get();
        // return $skip_category->id;
        // die();
        return view('frontend.index', compact('categories','sliders','products','featured','hotdeal','special_deals','special_offer','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_0','skip_brand_product_0'));
    }
    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }
    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);

            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Has Been Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }
    public function UserChangePassword()
    {

        return view('frontend.profile.change_password');
    }
    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            
        ]);

        $hasedpassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hasedpassword))
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('user.logout');
        }
        else{
            return redirect()->back();
        }
    }
    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id',$id)->get();

        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',',$color_hin);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',',$size_hin);

        $cat_id = $product->category_id;
        $related_product = Product::where('category_id', $cat_id)->orderBy('id','DESC')->get();



        return view('frontend.product.product_details',compact('product','multiImag','product_color_en','product_color_hin','product_size_en','product_size_hin','related_product'));
    }

    public function TagwiseProduct($tag){
        
        //$products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_hin',$tag)->orderBy('id','DESC')->get();
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_hin',$tag)->orderBy('id','DESC')->paginate(3);
        //dd($products);
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.tags.tags_view', compact('products','categories'));
    }

    public function CategorywiseProduct($subcatid,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$subcatid)->orderBy('id','DESC')->paginate(3);
        //dd($products);
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.subcategroy_view', compact('products','categories'));
    }

    public function SubSubCategorywiseProduct($subsubcatid, $slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcatid)->orderBy('id','DESC')->paginate(3);
        //dd($products);
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.subsubcategroy_view', compact('products','categories'));
    }

    public function ProductViewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

    }
}
