<?php

namespace App\Http\Controllers;

use App\Story;
use App\Coin;
use App\StoryImage;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{

    public function __construct(Coin $coin)
    {
        $this->coin = $coin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->views['stories'] = Story::latest()->paginate(50);

        return view('feed', $this->views);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if (Gate::denies('create', Story::class)) {
            return redirect()->route('connections.create')->withErrors('Unable to create story: Please make sure that the coin you entered is valid and if you\'re not the one who last posted a story using this coin.');
        }

        return view('stories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', Story::class);

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'required|image'
        ]);

        $attributes = array_merge(
            [
                'user_id' => auth()->id(),
                'coin_id' => $this->coin->exists($request->input('number'), $request->input('phrase'))->id
            ],
            $request->only('title', 'description', 'city', 'state', 'province', 'country')
        );

        $story = Story::create($attributes);

        if ($request->hasFile('image')) {
            $path = Storage::putfile('public/story/images', $request->file('image'));
            StoryImage::create(['story_id' => $story->id, 'filepath' => $path]);
        }

        return redirect()->route('stories.show', ['story' => $story])->with('success', 'Story has been added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        $this->views['story'] = $story;

        return view('stories.show', $this->views);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {

        $this->authorize('update', $story);

        $this->views['story'] = $story;
        return view('stories.edit', $this->views);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'nullable|image'
        ]);

        $story = Story::find($story->id);
        $story->user_id = auth()->id();
        $story->coin_id = $story->coin_id;
        $story->title = $request->input('title');
        $story->description = $request->input('description');
        $story->city = $request->input('city');
        $story->state = $request->input('state');
        $story->province = $request->input('province');
        $story->country = $request->input('country');
        $story->save();

        if ($request->hasFile('image')) {
            $path = Storage::putfile('public/story/images', $request->file('image'));

            $storyImage = StoryImage::find($story->id);
            $storyImage->filepath = $path;
            $storyImage->save();
        }

        return redirect()->back()->with('success', 'Story has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        $story->delete();

        return redirect('/')->with('success', 'Story has been deleted.');
    }

}
