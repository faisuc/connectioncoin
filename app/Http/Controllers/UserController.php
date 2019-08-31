<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified')->except('edit', 'update', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->views['user'] = $user;
        return view('users.show', $this->views);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $this->authorize('update', $user);

        $this->views['user'] = $user;

        return view('users.edit', $this->views);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $wpData = [];
    
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|unique:users,email,' . $user->id,
            'photo' => 'nullable|image',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $verifyEmail = false;

        $inputs = $request->all();

        if ( ! empty($inputs['password'])) {
            $originalPassword = $inputs['password'];
            $inputs['password'] = bcrypt($inputs['password']);
            $wpData['password'] = $originalPassword;
        } else {
            // $inputs = array_except($inputs, $inputs['password']);
            $inputs['password'] = $user->password;
        }

        if ($request->hasFile('photo')) {
            $path = Storage::putfile('public/user/profilephoto', $request->file('photo'));
            $inputs['photo'] = $path;
        } else {
            $inputs['photo'] = $user->photo;
        }

        if ($inputs['email'] != $user->email) {
            $inputs['email_verified_at'] = null;
            $verifyEmail = true;
            $wpData['email'] = $user->email;
            $wpData['new_email'] = $inputs['email'];
        } else {
            $inputs['email_verified_at'] = $user->email_verified_at;
            $wpData['email'] = $user->email;
        }

        $user = User::find($user->id);
        $user->email_verified_at = $inputs['email_verified_at'];
        $user->photo = $inputs['photo'];
        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];
        $user->password = $inputs['password'];
        $user->bio = $inputs['bio'];
        $user->save();

        $guzzleClient = new GuzzleClient;
        $response = $guzzleClient->post('http://store.connectioncoin.com/wp-json/connectioncoin/v1/store/user', [
            'form_params' => [
                'email' => $wpData['email'],
                'password' => isset($wpData['password']) ? $wpData['password'] : null,
                'new_email' => isset($wpData['new_email']) ? $wpData['new_email'] : null
            ]
        ]);

        $verifyEmail ? $user->sendEmailVerificationNotification() : '';

        return redirect()->back()->with('success', 'Profile has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
