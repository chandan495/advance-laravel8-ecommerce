<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;


class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add', compact('categories','brands'));
    }
    public function StoreProduct(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

       $product_id =  Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_hin' =>str_replace(' ', '-', $request->product_name_hin),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,
            'product_thumbnail' =>$save_url,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),   
        ]);

        //start multiple image 
        $images = $request->file('multi_image');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('manage-product')->with($notification);

    }//end method
    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }
    public function EditProduct($id){
        $multipleimage = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('categories','brands','subcategories','subsubcategories','products','multipleimage'));
    }
    public function ProductUpdate(Request $request){
        $product_id = $request->id;

        $id = Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_hin' =>str_replace(' ', '-', $request->product_name_hin),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,
            'hot_deals' => $request->hot_deals,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),   
        ]);
       // print_r($id);
        $notification = array(
            'message' => 'Product Update Without Image Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('manage-product')->with($notification);
    }

    public function MultiImageUpdate(Request $request){
            $images = $request->multi_img;

            foreach($images as $id =>  $img){
        
        $imgDel = MultiImg::findOrFail($id);
        //unlink($imgDel->photo_name);        
        //$image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$name_gen);
        $save_url = 'upload/products/multi-image/'.$name_gen;

        MultiImg::where('id',$id)->update([
            'photo_name' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        }
        $notification = array(
            'message' => 'Product Multiple image Updated Without Product Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ThumbImageUpdate(Request $request){
        $product_id = $request->id;
        $old_img = $request->old_img;
        //unlink($old_img);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Thumbanil image Updated Without Product Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    public function DeleteMultiImage($id){
        $old_img = MultiImg::findOrFail($id);
        unlink($old_img->photo_name);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi image Deleted Without Product Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ProductInactive($id){
        Product::findOrFail($id)->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'Product In Active has been sucessfully Done',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ProductActive($id){
        Product::findOrFail($id)->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'Product  Active has been sucessfully Done',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }
        $notification = array(
            'message' => 'Product  Deleted sucessfully Done',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ViewProduct($id){
        
        $multipleimage = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('backend.product.product_view_details',compact('categories','brands','subcategories','subsubcategories','products','multipleimage'));
    }
}
