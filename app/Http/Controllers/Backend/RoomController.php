<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\RoomNumber;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function EditRoom($id){

        $basic_facility = Facility::where('rooms_id',$id)->get();
        $multiimgs = MultiImage::where('rooms_id',$id)->get();
        $editData = Room::find($id);
        $allroomNo = RoomNumber::where('rooms_id',$id)->get();
        return view ('backend.allroom.rooms.edit_rooms',compact('editData', 'basic_facility','multiimgs','allroomNo'));

    } //end method

    public function DeleteRoom($id){

    }

    public function UpdateRoom(Request $request, $id){

        $room = Room::find($id);

       
        $room->roomtype_id = $room->roomtype_id;
        $room->total_adult = $request->total_adult; 
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price; 

        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style; 
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description; 
        /// Update Single Image

        if($request->file('image')){

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize(550, 850);
            // $img = save(base_path('public/upload/category/' . $category));

            $save_url = 'upload/roomimg/' . $name_gen; // Define the save URL

            $image->save(public_path($save_url));

            $room->image = $save_url;
        }

        $room->save();

        /// Update for Facility Table

        if($request->facility_name == NULL){

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'success',
            );
        
            return redirect()->back()->with($notification);

        }
        else {
            // Assuming the correct column name is 'rooms_id'
            Facility::where('rooms_id', $id)->delete();
            $facilities = Count($request->facility_name);
            for($i=0; $i < $facilities; $i++){
                $fcount = new Facility();
                $fcount->rooms_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            }
        }
        /// Update Multi Image

       if($room->save()){

            $files = $request->multi_img;
            if(!empty($files)){
                $subimage = MultiImage::where('rooms_id', $id)->get()->toArray();
                MultiImage::where('rooms_id',$id)->delete();
            }
            if(!empty($files)){
                foreach($files as $file){
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/roomimg/multi_imag/', $imgName);
                    $subimage['multi_img'] = $imgName;

                    $subimage =  new MultiImage();
                    $subimage->rooms_id = $room->id;
                    $subimage->multi_img = $imgName;
                    $subimage->save();
                }

            }

        }// end if

        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success',
        );
    
        return redirect()->back()->with($notification);

    }//end method

    public function MultiImageDelete($id){

        $deletedata = MultiImage::where('id', $id)->first();

        if($deletedata){

            $imagePath =  $deletedata->multi_img;

            //check if the file exists before unlinking
            if(file_exists($imagePath)){
                unlink($imagePath);
                echo "Image Unlink Successfully";
            }else{
                echo "Image does not exist";
            }

            //Delete the record form database

            MultiImage::where('id', $id)->delete();

        }
        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }//end method

    public function StoreRoomNumber(Request $request, $id){

        $data = new RoomNumber();
        $data->rooms_id = $id;
        $data->rooms_type_id = $request->rooms_type_id;
        $data->room_no = $request->room_no;
        $data->	status = $request->	status;
        $data->save();


        $notification = array(
            'message' => 'Room Number Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);



    } //end method

    public function  EditRoomNumber($id){

        $editroomno = RoomNumber::find($id);
        return view('backend.allroom.rooms.edit_room_no', compact('editroomno'));

    }// end method


    public function UpdateRoomNumber(Request $request, $id){

        $data =  RoomNumber::find($id);
        $data->room_no = $request->room_no;
        $data->status = $request -> status;
        $data->save();

        
        $notification = array(
            'message' => 'Room Number Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('room.type.list')->with($notification);

    } //end method

    public function DeleteRoomNumber($id){

        RoomNumber::find($id)->delete();

        $notification = array(
            'message' => 'Room Number Delected Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('room.type.list')->with($notification);


    } // end method

}
