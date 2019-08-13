<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryImage extends Model
{

    protected $fillable = [
        'story_id',
        'filepath'
    ];

    protected $primaryKey = 'story_id';

    public function story()
    {
        return $this->belongsTo('App\Story');
    }

}
