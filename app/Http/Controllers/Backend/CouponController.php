<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\MultiImg;
use Carbon\Carbon;

class CouponController extends Controller
{
    //
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('Backend.Coupon.view_coupon' , compact('coupons'));
    }


    public function CouponStore(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ],[
            'coupon_name.required' => 'Coupon Name is Required',
            'coupon_discount.required' => 'Coupon Discount is Required',
            'coupon_validity.required' => 'Coupon Validity Required',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper( $request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,           
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }
}
