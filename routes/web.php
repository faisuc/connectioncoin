<?php

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

use App\Coin;
use App\Role;
use App\Story;
use Illuminate\Support\Facades\Storage;

Route::get('stories', function () {
    return redirect()->route('stories.index');
});

Route::get('/', 'StoryController@index')->name('stories.index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified']);

Route::middleware(['auth', 'verified', 'role:admin|client'])->group(function () {

    Route::resource('connections', 'Coin\ConnectionController');

    Route::resource('stories', 'StoryController')->except(['index']);

    Route::resource('users', 'UserController')->except(['edit', 'update']);

});

Route::middleware(['auth', 'role:admin|client'])->group(function () {
    Route::resource('users', 'UserController')->only('edit', 'update');
});

Route::get('test', function () {

    $file = 'D:/PROJECTS/HOMESTEAD/madhatmedia/connectioncoin/storage/app/public/story/images/14QbybvgZebaHG7cnynsX77NmHanl8wnODvhb4mM.jpeg';
    $file = pathinfo($file, PATHINFO_FILENAME);

    dd($file);

    dd(public_path());
    $storagePath = Storage::getDriver()->getAdapter()->getPathPrefix();

    dd($storagePath);

    \DB::enableQueryLog();

    $story = new Story;
    $story->find(11)->getTheLastUsersWhoPostedUsingThisCoin(10);

    dd(\DB::getQueryLog());

    exit;

});