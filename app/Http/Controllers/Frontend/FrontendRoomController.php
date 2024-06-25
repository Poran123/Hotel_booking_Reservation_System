<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Intervention\Image\ImageServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use App\Models\Room;

class FrontendRoomController extends Controller
{
    public function AllFrontendRoomList(){

        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms',compact('rooms'));

    }//end method
}
