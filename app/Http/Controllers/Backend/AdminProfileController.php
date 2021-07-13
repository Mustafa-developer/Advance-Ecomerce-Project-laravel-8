<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminProfileController extends Controller
{
    //
    public function AdminProfile(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile', compact('adminData'));
    }

    public function AdminProfileEdit(){
        $editData = Admin::find(1);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function AdminProfileStore(Request $request){
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;


        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('uploads/admin_images/'.$data->profile_photo_path));
            $filename = date('Y-m-d-H-i').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $data['profile_photo_path']= $filename;
        }
        
        $data->save();

        $notification = array(
            'message' => 'Admin profile updated',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdateChangePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPassword = Admin::find(1)->password;
        if(Hash::check($request->oldpassword,$hashPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }
    }

}
