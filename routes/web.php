<?php
use App\RoomType;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$roomTypes = RoomType::all();
    return view('front', ['roomTypes' => $roomTypes]);
});
Route::post('register', 'ReservationController@makeForm');

Route::resource('reservation', 'ReservationController');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
