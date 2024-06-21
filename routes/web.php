<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('password/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
});

require __DIR__.'/auth.php';

// Admin group middleware
Route::middleware(['auth','roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    
}); // End admon group middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');



// Admin group middleware
Route::middleware(['auth','roles:admin'])->group(function(){

    //// Team All Route

    Route::controller(TeamController::class)->group(function(){

        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'deleteTeam')->name('delete.team');
        

    });


        //// Book Area All Route

    Route::controller(TeamController::class)->group(function(){

        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');
       
    });

    

        //// Room Type All Route

        Route::controller(RoomTypeController::class)->group(function(){

            Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
            Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
            Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store');
           
        });

            //// Room All Route

            Route::controller(RoomController::class)->group(function(){

                Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
                Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
                Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');

                Route::post('/store/room/no/{id}', 'StoreRoomNumber')->name('store.room.no');
                Route::get('/edit/roomno/{id}', 'EditRoomNumber')->name('edit.roomno');
                Route::post('/update/roomno/{id}', 'UpdateRoomNumber')->name('update.roomno');
                Route::get('/delete/roomno/{id}', 'DeleteRoomNumber')->name('delete.roomno');
            
                Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');
               
            });
        
    

}); // End admon group middleware
