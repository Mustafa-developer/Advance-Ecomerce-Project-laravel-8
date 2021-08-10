<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    //
    public function AddProduct(){
       $categories = Category::latest()->get();
       $brands = Brand::latest()->get();
       return view('Backend.Product.add-product' , compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request){
        
        $image = $request->file('product_thumbnail');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('uploads/products/Thumbnails/'.$image_gen);
        $save_url = 'uploads/products/Thumbnails/'.$image_gen;
        

        $product = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ur' => $request->product_name_ur,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ur' => str_replace(' ', '-', $request->product_name_ur),
            'product_code' => $request->product_code,
  
            'product_qty' => $request->product_qty,
            'product_tag_en' => $request->product_tag_en,
            'product_tag_ur' => $request->product_tag_ur,
            'product_size_en' => $request->product_size_en,
            'product_size_ur' => $request->product_size_ur,
            'product_color_en' => $request->product_color_en,
            'product_color_ur' => $request->product_color_ur,
  
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_ur' => $request->short_desc_ur,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_ur' => $request->long_desc_ur,
  
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
  
            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),    
  
        ]);

        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('uploads/products/Multi_img/'.$make_name);
            $uploadPath = 'uploads/products/Multi_img/'.$make_name;

            MultiImg::insert([
                'product_id' => $product,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);

        }


    

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('Backend.Product.manage-product' , compact('products'));
    }

    public function EditProduct($id){

        $multiImags = MultiImg::where('product_id' , $id)->get();

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('Backend.Product.edit_product' , compact('brands','categories','subcategories','subsubcategories','products' , 'multiImags'));

    }

    public function UpdateProduct(Request $request, $id){
       

        Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ur' => $request->product_name_ur,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ur' => str_replace(' ', '-', $request->product_name_ur),
            'product_code' => $request->product_code,
  
            'product_qty' => $request->product_qty,
            'product_tag_en' => $request->product_tag_en,
            'product_tag_ur' => $request->product_tag_ur,
            'product_size_en' => $request->product_size_en,
            'product_size_ur' => $request->product_size_ur,
            'product_color_en' => $request->product_color_en,
            'product_color_ur' => $request->product_color_ur,
  
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_ur' => $request->short_desc_ur,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_ur' => $request->long_desc_ur,
  
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
  
            'status' => 1,
            'created_at' => Carbon::now(),    
  
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);


    }

    public function MultiImageUpdate(Request $request){
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('uploads/products/Multi_img/'.$make_name);
            $uploadPath = 'uploads/products/Multi_img/'.$make_name;

            MultiImg::where('id' , $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => carbon::now(),
            ]);
            
        }
        $notification = array(
            'message' => 'Product images Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }


    public function ThumbailImageUpdate(Request $request){
        $pro_id = $request->id;
        $old_img = $request->old_img;

        if($image = $request->file('product_thumbnail')){
        
        unlink($old_img);

        $image = $request->file('product_thumbnail');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('uploads/products/Thumbnails/'.$image_gen);
        $save_url = 'uploads/products/Thumbnails/'.$image_gen;
        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);

        }else{
        Product::findOrFail($pro_id)->update([
            
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    }


    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product images deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function ProductInActive($id){
        Product::findOrFail($id)->update([ 'status' => 0 ]);
        $notification = array(
            'message' => 'Product InActive  Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function ProductActive($id){
        Product::findOrFail($id)->update([ 'status' => 1 ]);
        $notification = array(
            'message' => 'Product Active  Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function ProductDelete($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);

        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id' , $id)->get();

        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);

    }


}
