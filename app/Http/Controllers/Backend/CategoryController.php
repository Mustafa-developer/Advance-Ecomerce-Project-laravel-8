<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function CategoryView(){
        $cats = Category::latest()->get();
        return view('Backend.category.view_category',compact('cats'));
    }

    public function CategoryStore(Request $request){
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ur' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Category Name In English',
            'category_name_ur.required' => 'Category Name In Urdu',
            'category_icon.required' => 'Category Icon Please',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_ur' => $request->category_name_ur,
            'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
            'category_slug_ur' => str_replace(' ','-',$request->category_name_ur),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }


    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('Backend.category.category_edit' , compact('category'));
    }


    public function CategoryUpdate(Request $request){
        $cat_id = $request->category_id;     
            Category::findOrFail($cat_id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_ur' => $request->category_name_ur,
                'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
                'category_slug_ur' => str_replace(' ','-',$request->category_name_ur),
                'category_icon' => $request->category_icon,
                
            ]);

            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'info',
            );

            return Redirect()->route('all.category')->with($notification);        
    }

    public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'info',
        );

        return Redirect()->back()->with($notification);
    }


}
