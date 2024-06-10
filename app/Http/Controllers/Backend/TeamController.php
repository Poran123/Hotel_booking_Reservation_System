<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;


class TeamController extends Controller
{
    public function AllTeam(){

        $teams = Team::latest()->get();
        return view('backend.team.all_team', compact('teams'));

    } //end method

    public function AddTeam(){
        
        return view('backend.team.add_team');

    } //end method

    public function StoreTeam(Request $request){
        
        if($request->file('image')){
            // $manager = new ImageManager(new Driver());
            // $name_gen  = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            // $img = $manager->read($request->file('image'));
            // $img = $img->resize(550,570);

            // $img->toJpeg(80)->save(base_path('public/upload/team/'.$name_gen));
            // $save_url = 'upload/team/'.$name_gen;


            
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(550, 570);
            // $img = save(base_path('public/upload/category/' . $category));

            $save_url = 'upload/team/' . $name_gen; // Define the save URL

            $img->save(public_path($save_url));

            Team::insert([
            
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            
        }  // end if conition

        // $image = $request->file('image');
        // $name_gen  = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(550,670)->save('upload/team'.$name_gen);
        // $save_url = 'upload/team/'.$name_gen;

        
        $notification = array(
            'message' => 'Team Data Inserted Successfully',
            'alert-type' => 'success',
    );
    
        return redirect()->route('all.team')->with($notification);

    } //end method

    public function EditTeam($id){

        $team = Team::find($id);
        return view('backend.team.edit_team',compact('team'));

    } //end method


    public function UpdateTeam(Request $request){

        $team_id = $request->id;

        $team = Team::find($team_id);

        if($request->file('image')){
            // $manager = new ImageManager(new Driver());
            // $image = $request->file('image');
            // $name_gen  = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            // Image::make($image)->resize(550,670)->save('upload/team'.$name_gen);
            // $save_url = 'upload/team/'.$name_gen;



            if (file_exists($team->image)) {
                unlink($team->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(550, 670);
            // $img = save(base_path('public/upload/category/' . $category));

            $save_url = 'upload/team/' . $name_gen; // Define the save URL

            $img->save(public_path($save_url));


            Team::find($team_id)->update ([
            
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' =>  $save_url,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Team Updated With Image Successfully',
                'alert-type' => 'success',
        );
        
            return redirect()->route('all.team')->with($notification);

        } else{

            Team::find($team_id)->update ([
            
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Team Updated Without Image Successfully',
                'alert-type' => 'success',
        );
        
            return redirect()->route('all.team')->with($notification);

        }//End Else

    } // end method
    public function DeleteTeam($id)
    {
        $item = Team::find($id);
        $img = $item->image;
    
        if (file_exists($img)) {
            unlink($img);
        } else {
            $notification = array(
                'message' => 'Team Image not found, unable to delete.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    
        Team::findOrFail($id)->delete();
    
        $notification = array(
            'message' => 'Team Image Deleted Successfully',
            'alert-type' => 'success',
        );
    
        return redirect()->back()->with($notification);
    }// end method

    //============= Book Area All Methods ===============

    public function BookArea(){

        $book = BookArea::find(1);
        return view('backend.bookarea.book_area',compact('book'));

    } //end method

    public function BookAreaUpdate(Request $request)
{
    $book_id = $request->id;
    if($request->file('image')){
        // $manager = new ImageManager(new Driver());
        // $image = $request->file('image');
        // $name_gen  = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(1000,1000)->save('upload/bookarea'.$name_gen);
        // $save_url = 'upload/bookarea/'.$name_gen;

    // if ($request->file('image')) {
    //     $image = $request->file('image');
    //     $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    //     Image::make($image)->resize(1000, 1000)->save('upload/bookarea/'.$name_gen);
    //     $save_url = 'upload/bookarea/'.$name_gen;

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(1000, 1000);
            // $img = save(base_path('public/upload/category/' . $category));

            $save_url = 'upload/bookarea/' . $name_gen; // Define the save URL

            $img->save(public_path($save_url));

        BookArea::find($book_id)->update([
            'short_title' => $request->short_title, // Update the column name to match the database
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc, // Update the column name to match the database
            'link_url' => $request->link_url,
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Book Area Updated With Image Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } else {
        BookArea::find($book_id)->update([
            'short_title' => $request->short_title, // Update the column name to match the database
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc, // Update the column name to match the database
            'link_url' => $request->link_url,
        ]);

        $notification = array(
            'message' => 'Book Area Updated Without Image Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
    
}
