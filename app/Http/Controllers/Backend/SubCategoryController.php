<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    //
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $cats = SubCategory::latest()->get();
        return view('Backend.category.view_subcategory',compact('cats' , 'categories'));
    }

    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_ur' => 'required',
            
        ],[
            'category_id.required' => 'Select Category Please',
            'subcategory_name_en.required' => 'Sub Category Name In English',
            'subcategory_name_ur.required' => 'Sub Category Name In Urdu',
           
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ur' => $request->subcategory_name_ur,
            'subcategory_slug_en' => strtolower(str_replace(' ','-', $request->subcategory_name_en)),
            'subcategory_slug_ur' => str_replace(' ','-',$request->subcategory_name_ur),
            
        ]);

        $notification = array(
            'message' => 'Sub Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $cats = SubCategory::findOrFail($id);
        return view('Backend.category.subcategory_edit',compact('cats' , 'categories'));
    }

    public function SubCategoryUpdate(Request $request){
        $id = $request->subcategory_id;

        SubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ur' => $request->subcategory_name_ur,
            'subcategory_slug_en' => strtolower(str_replace(' ','-', $request->subcategory_name_en)),
            'subcategory_slug_ur' => str_replace(' ','-',$request->subcategory_name_ur),
            
        ]);

        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'info',
        );

        return Redirect()->back()->with($notification);
    }


    ////////////////////////////   All Sub SubCategory Methods  ///////////////////////////

    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sub_subcat = SubSubCategory::latest()->get();
        return view('Backend.category.view_sub_subcategory',compact('sub_subcat' , 'categories'));
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

   
    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_name_en' => 'required',
            'sub_subcategory_name_ur' => 'required',
            
        ],[
            'category_id.required' => 'Select Category Please',
            'sub_subcategory_name_en.required' => 'Sub SubCategory Name In English',
            'sub_subcategory_name_ur.required' => 'Sub SubCategory Name In Urdu',
           
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_ur' => $request->sub_subcategory_name_ur,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ','-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_ur' => str_replace(' ','-',$request->sub_subcategory_name_ur),
            
        ]);

        $notification = array(
            'message' => 'Sub SubCategory Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $cats = SubSubCategory::findOrFail($id);
        return view('Backend.category.sub_subcategory_edit',compact('cats' , 'categories','subcategories'));
    }

    public function SubSubCategoryUpdate(Request $request){
        $id = $request->subsub_id;

        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_ur' => $request->sub_subcategory_name_ur,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ','-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_ur' => str_replace(' ','-',$request->sub_subcategory_name_ur),
            
        ]);

        $notification = array(
            'message' => 'Sub->SubCategory Updated Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub->SubCategory Deleted Successfully',
            'alert-type' => 'danger',
        );

        return Redirect()->back()->with($notification);
    }


}
