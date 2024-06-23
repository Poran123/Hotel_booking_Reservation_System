<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        // $team = Team::latest()->get();

        return view('frontend.index');
    } //end method

    public function UserProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('profileData'));

    } //end method

    
    public function UserStore(Request $request)
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
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename); // Fixing the path here
            $data['photo'] = $filename;
        }
        $data->save();
    
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
    );
    
        return redirect('/profile')->with($notification);

    } //end method

    public function UserLogout(Request $request) {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
    );
    

        return redirect('/login')->with($notification);
    } //end method

    public function UserChangePassword(){

        return view('frontend.dashboard.user_change_password');

    }

    public function ChangePasswordStore(Request $request){

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




