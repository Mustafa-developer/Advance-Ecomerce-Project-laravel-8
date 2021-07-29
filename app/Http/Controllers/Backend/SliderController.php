<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    //
    public function SliderView(){
        $sliders = Slider::latest()->get();
        return view('Backend.Slider.view_slider' , compact('sliders'));
    }

    public function SliderStore(Request $request){
        $request->validate([           
            'slider_img' => 'required',
        ],[
            'slider_img.required' => 'please Select one image for the Slider',            
        ]);

        $image = $request->file('slider_img');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('uploads/sliders/'.$image_gen);
        $save_url = 'uploads/sliders/'.$image_gen;
        
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,            
            'slider_img' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function SliderEdit($id){
        $slider = Slider::findOrFail($id);
        return view('Backend.Slider.slider_edit' , compact('slider'));
    }

    public function SliderUpdate(Request $request){
        $slider_id = $request->slider_id;
        $old_image = $request->old_image;

        if($request->file('slider_img')){

            unlink($old_image);

            $image = $request->file('slider_img');
            $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('uploads/sliders/'.$image_gen);
            $save_url = 'uploads/sliders/'.$image_gen;
            
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info',
            );

            return Redirect()->route('manage-slider')->with($notification);
        }else{

            SLider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,              
            ]);

            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info',
            );

            return Redirect()->route('manage-slider')->with($notification);

        }
    }

    public function SliderInActive($id){
        Slider::findOrFail($id)->update([ 'status' => 0 ]);
        $notification = array(
            'message' => 'Slider InActive  Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function SliderActive($id){
        Slider::findOrFail($id)->update([ 'status' => 1 ]);
        $notification = array(
            'message' => 'Slider Active  Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }


    public function SliderDelete($id){
        $slider = Slider::findOrFail($id);
        $image = $slider->slider_img;

        unlink($image);
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'info',
        );

        return Redirect()->back()->with($notification);
    }

}
