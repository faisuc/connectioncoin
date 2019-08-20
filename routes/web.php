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
use App\Message;
use App\Role;
use App\Story;
use App\User;
use Illuminate\Support\Facades\Auth;
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

    // Route::get('/conversations/{user_id}', 'MessageController@getMessagesFor');

    Route::get('users/info/{user}', function ($user) {
        if ((int) $user == auth()->id()) {
            abort(404);
        }
        return response()->json(User::findOrFail($user), 200);
    });

    Route::resource('users', 'UserController')->except(['edit', 'update', 'show']);

    Route::resource('messages', 'MessageController')->except(['show']);

    Route::get('messages/{message?}', 'MessageController@show')->name('messages.show');

    Route::resource('comments', 'CommentController');

});

Route::middleware(['auth', 'role:admin|client'])->group(function () {
    Route::resource('users', 'UserController')->only('edit', 'update');
});


Route::get('users/{user}/coins', 'ShowUserCoinsController')->name('users.coins.index');

Route::get('users/{user}/stories', 'ShowUserStoriesController')->name('users.stories.index');

Route::get('users/{user}', 'UserController@show')->name('users.show');

Route::get('test', function () {

    $messages = Auth::user()->messages();

    foreach ($messages as $message) {
        echo $message->text . '<br />';
    }

    exit;

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

    $contacts = User::where('id', '<>', auth()->id())->get();

    // getMessagesFor($id)
    // $messages = Message::where('from', $id)->orWhere('to', $id)->get();

    exit;

});