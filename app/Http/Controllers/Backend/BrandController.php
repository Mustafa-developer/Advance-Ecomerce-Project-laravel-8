<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    //
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('Backend.brand.view_brands',compact('brands'));
    }

    public function BrandStore(Request $request){
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_ur' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Brand Name In English',
            'brand_name_ur.required' => 'Brand Name In Urdu'
        ]);

        $image = $request->file('brand_image');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('uploads/brand/'.$image_gen);
        $save_url = 'uploads/brand/'.$image_gen;
        
        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ur' => $request->brand_name_ur,
            'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)),
            'brand_slug_ur' => str_replace(' ','-',$request->brand_name_ur),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit' , compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $brand_id = $request->brand_id;
        $old_image = $request->old_image;

        if($request->file('brand_image')){

            unlink($old_image);

            $image = $request->file('brand_image');
            $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('uploads/brand/'.$image_gen);
            $save_url = 'uploads/brand/'.$image_gen;
            
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ur' => $request->brand_name_ur,
                'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)),
                'brand_slug_ur' => str_replace(' ','-',$request->brand_name_ur),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info',
            );

            return Redirect()->route('all.brand')->with($notification);
        }else{

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ur' => $request->brand_name_ur,
                'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)),
                'brand_slug_ur' => str_replace(' ','-',$request->brand_name_ur),
                
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info',
            );

            return Redirect()->route('all.brand')->with($notification);

        }
    }


    public function BrandDelete($id){
        $brand = Brand::findOrFail($id);
        $image = $brand->brand_image;

        unlink($image);
        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'info',
        );

        return Redirect()->back()->with($notification);
    }

}
