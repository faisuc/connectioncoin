<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ShowUserStoriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $user_id = null)
    {
        $this->views['user'] = $user = User::findOrFail($user_id);

        $this->views['stories'] = $user->stories()->withTrashed()->get();

        return view('users.stories.index', $this->views);
    }
}
