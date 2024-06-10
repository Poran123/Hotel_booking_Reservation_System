<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function EditRoom($id){

        $editData = Room::find($id);
        return view ('backend.allroom.rooms.edit_rooms',compact('editData'));

    } //end method

    public function DeleteRoom($id){

    }
}
