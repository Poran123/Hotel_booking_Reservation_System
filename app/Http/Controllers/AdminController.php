<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

    } //End Method

    public function AdminLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //end method

    public function AdminLogin(){

        return view('admin.admin_login');

    } //end method

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));

    } //end method


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
    
        // Update user data
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
    
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename); // Fixing the path here
            $data['photo'] = $filename;
        }
        $data->save();
    
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
    );
    
        return redirect()->back()->with($notification);
    } //end method

    public function AdminChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    } //end method

    public function AdminPasswordUpdate(Request $request){

        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);


        if(!Hash::check($request->old_password, auth::user()->password)){

            $notification = array(
                'message' => 'Old Password Does not Mathc!',
                'alert-type' => 'error',
        );
        
            return back()->with($notification);

        }

        //update the new password

        user::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success',
    );
    
        return back()->with($notification);


    } //end method
    
}
