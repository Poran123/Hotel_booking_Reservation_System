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
        
    } //end method

    public function AddRoomType(){
        return view ('backend.allroom.roomtype.add_roomtype');
    }

    public function RoomTypeStore(Request $request){
    $roomtype_id = RoomType::insertGetId([
        'name' => $request->name,
        'created_at' => Carbon::now(),
    ]);

    $room = new Room();
    $room->roomtype_id = $roomtype_id;
    $room->total_adult = 0; // Set a default value for total_adult
    $room->save();

    $notification = array(
        'message' => 'Room Type Inserted Successfully',
        'alert-type' => 'success',
    );

    return redirect()->route('room.type.list')->with($notification);
}
}
