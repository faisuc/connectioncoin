<?php

namespace App\Policies;

use App\Coin;
use App\User;
use App\Story;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class StoryPolicy
{
    use HandlesAuthorization;

    public function __construct(Coin $coin)
    {
        $this->coin = $coin;
    }

    /**
     * Determine whether the user can view any stories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function view(User $user, Story $story)
    {
        //
    }

    /**
     * Determine whether the user can create stories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        $request = Request::has('number') && Request::has('phrase');
        $coin = $this->coin->exists(Request::input('number'), Request::input('phrase'));

        if ($this->coin->find($coin->id)->lastPostedStory() === null) {
            $lastPost = true;
        } elseif ($this->coin->find($coin->id)->lastPostedStory()->user_id != $user->id) {
            $lastPost = true;
        } else {
            $lastPost = false;
        }

        return $request && $coin && $lastPost;
    }

    /**
     * Determine whether the user can update the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function update(User $user, Story $story)
    {
        return $user->id == $story->user_id;
    }

    /**
     * Determine whether the user can delete the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function delete(User $user, Story $story)
    {
        return $user->id == $story->user_id;
    }

    /**
     * Determine whether the user can restore the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function restore(User $user, Story $story)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the story.
     *
     * @param  \App\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function forceDelete(User $user, Story $story)
    {
        //
    }
}
