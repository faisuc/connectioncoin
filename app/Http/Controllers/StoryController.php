<?php

namespace App\Http\Controllers;

use App\Story;
use App\Coin;
use App\StoryImage;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

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
            'image' => 'required|image|dimensions:min_width=250,min_height:500'
        ], ['image.dimensions' => 'Please upload an image that has a minimum width of 250px and minimum height of 500px']);

        $attributes = array_merge(
            [
                'user_id' => auth()->id(),
                'coin_id' => $this->coin->exists($request->input('number'), $request->input('phrase'))->id
            ],
            $request->only('title', 'description', 'city', 'state', 'province', 'country')
        );

        $story = Story::create($attributes);

        if ($request->hasFile('image')) {

            $filenameWithExtension = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension =$request->file('image')->getClientOriginalExtension();
            $time = time();
            $filenameToStore = $filename . '_' . $time . '.' . $extension;
            $filenameToStoreResize = $filename . '_' . $time . '-497x290.' . $extension;

            $request->file('image')->storeAs('public/story/images', $filenameToStore);

            // $path = Storage::putfile('public/story/images', $request->file('image'));

            Image::load(storage_path('app/public/story/images/' . $filenameToStore))
                    ->fit(Manipulations::FIT_FILL, 497, 290)
                    ->save(storage_path('app/public/story/images/' . $filenameToStoreResize));

            // $path = Storage::putfile('public/story/images', $request->file('image'));
            StoryImage::create(['story_id' => $story->id, 'filepath' => 'public/story/images/' . $filenameToStore]);
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
            'image' => 'nullable|image|dimensions:min_width=250,min_height:500'
        ], ['image.dimensions' => 'Please upload an image that has a minimum width of 250px and minimum height of 500px']);

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

            $filenameWithExtension = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension =$request->file('image')->getClientOriginalExtension();
            $time = time();
            $filenameToStore = $filename . '_' . $time . '.' . $extension;
            $filenameToStoreResize = $filename . '_' . $time . '-497x290.' . $extension;

            $request->file('image')->storeAs('public/story/images', $filenameToStore);

            // $path = Storage::putfile('public/story/images', $request->file('image'));

            Image::load(storage_path('app/public/story/images/' . $filenameToStore))
                    ->fit(Manipulations::FIT_FILL, 497, 290)
                    ->save(storage_path('app/public/story/images/' . $filenameToStoreResize));

            $storyImage = StoryImage::find($story->id);
            $storyImage->filepath = 'public/story/images/' . $filenameToStore;
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
