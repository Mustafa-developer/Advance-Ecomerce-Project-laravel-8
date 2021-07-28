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
        return view('Backend.Slider.view_slider.blade.php');
    }
}
