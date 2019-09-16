<?php

namespace App\Http\Controllers;

use App\Mail\ReportStory;
use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportStoryController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $story_id = $request->input('story_id');
            $message = $request->input('message');
            $story = Story::find($story_id);

            Mail::to($story->user->email)->send(
                new ReportStory($story, $message)
            );
            return response()->json(['success' => '123']);
        }
    }
}
