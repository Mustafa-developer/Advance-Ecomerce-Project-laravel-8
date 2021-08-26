<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index(){
        $products = Product::where('status' , 1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Product::where('featured' , 1)->where('status' , 1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals' , 1)->where('status' , 1)->where('discount_price' ,'!=' , Null)->orderBy('id','DESC')->limit(6)->get();
        $special_offer = Product::where('special_offer' , 1)->where('status' , 1)->orderBy('id','DESC')->limit(4)->get();
        $special_deals = Product::where('special_deals' , 1)->where('status' , 1)->orderBy('id','DESC')->limit(4)->get();
        $sliders = Slider::where('status' , 1)->orderBy('id','DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en' ,'ASC')->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status','1')->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();
        
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status','1')->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();
        
        $skip_brand_0 = Brand::skip(0)->first();
        $skip_product_brand_0 = Product::where('status','1')->where('brand_id',$skip_brand_0->id)->orderBy('id','DESC')->get();

        return view('frontend.index' ,compact('categories','sliders','products','featured','hot_deals','special_offer','special_deals',
        'skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_0','skip_product_brand_0'));
    }

    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $users = User::find($id);
        return view('frontend.profile.user_profile' , compact('users'));
    }

    public function UserProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;


        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('uploads/user_images/'.$data->profile_photo_path));
            $filename = date('Y-m-d-H-i').$file->getClientOriginalName();
            $file->move(public_path('uploads/user_images'),$filename);
            $data['profile_photo_path']= $filename;
        }
        
        $data->save();

        $notification = array(
            'message' => 'User profile updated',
            'alert-type' => 'success',
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword(){
        $id = Auth::user()->id;
        $users = User::find($id);
        return view('frontend.profile.change_password' , compact('users'));
    }

    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }



    public function ProductDetails($id , $slug){
        $product = Product::findOrFail($id);


        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);
        
        $color_ur = $product->product_color_ur;
        $product_color_ur = explode(',',$color_ur);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_ur = $product->product_size_ur;
        $product_size_ur = explode(',',$size_ur);

        $cat_id = $product->category_id;
        $related_products = Product::where('category_id' , $cat_id)->where('id' , '!=' , $id)->orderBy('id',  'DESC')->get();

        $multi = MultiImg::where('product_id' , $id)->get();
        return View('frontend.product.product_details', compact('product', 'multi','product_color_en','product_color_ur'
        , 'product_size_en', 'product_size_ur','related_products'));
    }


    public function TagWiseProduct($tag){
        $products_tags = Product::where('status', 1)->where('product_tag_en',$tag)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en' ,'ASC')->get();
        return view('frontend.tags.view_tags' , compact('products_tags','categories'));
    }

    public function SubCatgeoryWiseProduct($subcat_id , $slug){
        $subcategory_products = Product::where('status', 1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en' ,'ASC')->get();
        return view('frontend.product.subcategory_product_view' , compact('subcategory_products','categories'));
    }

    public function SubSubCatgeoryWiseProduct($subcat_id , $slug){
        $subsubcategory_products = Product::where('status', 1)->where('subsubcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en' ,'ASC')->get();
        return view('frontend.product.subsubcategory_product_view' , compact('subsubcategory_products','categories'));
    }

    public function ProductViewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);
      
        $color = $product->product_color_en;
        $product_color = explode(',' , $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product ,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

}
