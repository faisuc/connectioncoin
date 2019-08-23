<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryLike extends Model
{

    protected $fillable = [
        'reaction_id', 'user_id', 'story_id'
    ];

    public function stories()
    {
        return $this->belongsToMany('App\Story')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

}
