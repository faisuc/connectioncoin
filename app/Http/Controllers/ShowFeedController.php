<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;

class ShowFeedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $this->views['stories'] = Story::latest()->paginate(50);

        return view('feed', $this->views);

    }
}
