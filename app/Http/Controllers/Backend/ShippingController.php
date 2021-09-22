<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingController extends Controller
{
    //

    public function DivisionView(){
        $divisions = Shipping::orderBy('id','DESC')->get();
        return view('Backend.ship.division.view_division' , compact('divisions'));
    }

    public function DivisionStore(Request $request){
        $request->validate([
            'division_name' => 'required',
        ],
        [
            'division_name.required' => 'Coupon Name is Required',            
        ]);

        Shipping::insert([
            'division_name' => $request->division_name,                 
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function DivisionEdit($id){
        $division = Shipping::findOrFail($id);
        return view('Backend.ship.division.edit_division', compact('division'));
    }

    public function DivisionUpdate(Request $request , $id){
        Shipping::findOrFail($id)->update([
            'division_name' => $request->division_name,          
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-division')->with($notification);
    }

    public function DivisionDelete($id){
        Shipping::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-division')->with($notification);
    }


    // Districk  Functions

    public function DistrictView(){
        $divisions = Shipping::orderBy('division_name','DESC')->get();
        $district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('Backend.ship.district.view_district' , compact('divisions' ,'district'));
    }

    public function DistrictStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,                 
            'district_name' => $request->district_name,                 
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);
    }

    public function DistrictEdit($id){
        $divisions = Shipping::orderBy('division_name','DESC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('Backend.ship.district.edit_district', compact('divisions','district'));
    }

    public function DistrictUpdate(Request $request , $id){
        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,          
            'district_name' => $request->district_name,          
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-district')->with($notification);
    }

    public function DistrictDelete($id){
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-district')->with($notification);
    }


    // Ship  State Functions


    public function StateView(){
        $divisions = Shipping::orderBy('division_name','ASC')->get();
        $state = ShipState::latest()->get();
        return view('Backend.ship.state.view_state' , compact('divisions' ,'state'));
    }


    public function GetDistrictData($id){
     
        $district = ShipDistrict::where('division_id' , $id)->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }


    public function StateStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state' => 'required',
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,                 
            'district_id' => $request->district_id,                 
            'state' => $request->state,                 
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->back()->with($notification);  
    }

    public function StateEdit($id){
        $divisions = Shipping::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('Backend.ship.state.edit_state', compact('divisions','district','state'));
    }

    public function StateUpdate(Request $request , $id){
        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,          
            'district_id' => $request->district_id,          
            'state' => $request->state,          
            'created_at' => Carbon::now(),           
        ]);

        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-state')->with($notification);
    }

    public function StateDelete($id){
        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success',
        );

        return Redirect()->route('manage-state')->with($notification);
    }
    

}
