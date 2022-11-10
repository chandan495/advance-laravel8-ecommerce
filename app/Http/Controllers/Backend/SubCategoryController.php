<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory','categories'));
    }
    public function SubCategoryStore(Request $request)
    {
        $request->validate([
            'sub_category_name_en' => 'required',
            'sub_category_name_hin' => 'required',
            'category_id' => 'required',
        ],[
            'sub_category_name_en.required' => 'Enter Sub Category English name',
            'sub_category_name_hin.required' => 'Enter Sub Category Hindi name',
        ]);

        SubCategory::insert([
            'category_id' =>   $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_name_hin' => $request->sub_category_name_hin,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-',$request->sub_category_name_en)),
            'sub_category_slug_hin' => str_replace(' ', '-',$request->sub_category_name_hin),
            
        ]);

        $notification = array(
            'message' => 'Sub Category Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en','ASC')->get(); 
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory','categories'));
    }
    public function SubCategoryUpdate(Request $request)
    {
        $subcategory_id = $request->id;
        SubCategory::findOrFail($subcategory_id)->update([
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_name_hin' => $request->sub_category_name_hin,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-',$request->sub_category_name_en)),
            'sub_category_slug_hin' => str_replace(' ', '-',$request->sub_category_name_hin),
            'category_id' =>   $request->category_id,
        ]);

        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert_type' => 'info'
        );
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function SubCategoryDelete($id){
        
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //Sub Sub category

    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        // $subcategories = SubCategory::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_category_view', compact('categories','subsubcategory'));
    }
    Public function GetSubcategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('sub_category_name_en', 'ASC')->get();
        return json_encode($subcat);
    }
    Public function GetSubSubcategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsub_category_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }
    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'subsub_category_name_en' => 'required',
            'subsub_category_name_hin' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ],[
            'subsub_category_name_en.required' => 'Enter Sub->sub Category English name',
            'category_id.required' => 'Enter  Category English name',
            'subsub_category_name_hin.required' => 'Enter Sub->sub Category Hindi name',
        ]);

        SubSubCategory::insert([
            'category_id' =>   $request->category_id,
            'subcategory_id' =>   $request->subcategory_id,
            'subsub_category_name_en' => $request->subsub_category_name_en,
            'subsub_category_name_hin' => $request->subsub_category_name_hin,
            'subsub_category_slug_en' => strtolower(str_replace(' ', '-',$request->subsub_category_name_en)),
            'subsub_category_slug_hin' => str_replace(' ', '-',$request->subsub_category_name_hin),
            
        ]);

        $notification = array(
            'message' => 'Sub->Sub Category Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('sub_category_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_subcategory_edit', compact('categories','subcategories','subsubcategories'));

    }
    public function SubSubCategoryUpdate(Request $request){
        $subsubcategory_id = $request->id;
        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'subsub_category_name_en' => $request->subsub_category_name_en,
            'subsub_category_name_hin' => $request->subsub_category_name_hin,
            'subsub_category_slug_en' => strtolower(str_replace(' ', '-',$request->subsub_category_name_en)),
            'subsub_category_slug_hin' => str_replace(' ', '-',$request->subsub_category_name_hin),
            'category_id' =>   $request->category_id,
            'subcategory_id' =>   $request->subcategory_id,
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Updated Successfully',
            'alert_type' => 'info'
        );
        return redirect()->route('all.subsubcategory')->with($notification);
    }
    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub->sub Category Deleted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
