<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\BookArea;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use App\Models\Room;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){

        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));

    }// End Method 

    
    public function AddRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method 

    public function RoomTypeStore(Request $request){
        // Insert the RoomType and get the ID
        $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
    
        // Insert the Room with the roomtype_id
        Room::insert([
            'roomtype_id' => $roomtype_id,
            'created_at' => Carbon::now(), // Assuming you want to set the created_at timestamp
            'updated_at' => Carbon::now()  // Assuming you want to set the updated_at timestamp
        ]);
    
        // Create a notification array
        $notification = array(
            'message' => 'RoomType Inserted Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect to the room type list with the notification
        return redirect()->route('room.type.list')->with($notification);
    } // End Method
     


//     public function RoomTypeStore(Request $request){
//     $roomtype_id = RoomType::insertGetId([
//         'name' => $request->name,
//         'created_at' => Carbon::now(),
//     ]);

//     $room = new Room();
//     $room->roomtype_id = $roomtype_id;
//     $room->total_adult = 0; // Set a default value for total_adult
   
//     //$room->save();

//     $notification = array(
//         'message' => 'Room Type Inserted Successfully',
//         'alert-type' => 'success',
//     );

//     return redirect()->route('room.type.list')->with($notification);
// }
}
