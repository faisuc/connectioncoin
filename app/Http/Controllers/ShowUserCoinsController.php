<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ShowUserCoinsController extends Controller
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

        $this->views['stories'] = $user->stories()->withTrashed()->select('coin_id')->where('user_id', $user->id)->groupBy('coin_id')->get();

        return view('users.coins.index', $this->views);
    }
}
