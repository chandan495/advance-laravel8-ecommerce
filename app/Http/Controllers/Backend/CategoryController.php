<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }
    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_hin' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Enter Category English name',
            'category_name_hin.required' => 'Enter Category Hindi name',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_hin' => $request->category_name_hin,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
            'category_icon' =>   $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }
    public function CategoryUpdate(Request $request)
    {
        $category_id = $request->id;
        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_hin' => $request->category_name_hin,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
            'category_icon' =>   $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert_type' => 'info'
        );
        return redirect()->route('all.category')->with($notification);
    }
    public function CategoryDelete($id){
        
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
