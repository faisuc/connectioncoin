<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Story extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'coin_id',
        'title',
        'description',
        'city',
        'state',
        'province',
        'country',
    ];

    public function coin()
    {
        return $this->belongsTo('App\Coin');
    }

    public function lastTwoUsersWhoPostedUsingThisCoin()
    {
        return Story::where('coin_id', $this->coin_id)->latest()->take(2)->get();
    }

    public function image()
    {
        return $this->hasOne('App\StoryImage');
    }

    public function getTheIsPostedOrUpdatedDatePrefixAttribute()
    {
        $suffix = $this->created_at == $this->updated_at ? 'Posted' : 'Last updated';

        return $suffix;
    }

    public function getTheDescriptionAttribute()
    {
        return Str::limit($this->description, '100', '<br /><a href="' . route('stories.show', ['story' => $this->id]) . '">Read more</a>');
    }

    public function getTheFormattedTimeAgoAttribute()
    {
        return $this->theIsPostedOrUpdatedDatePrefix . ' ' . $this->created_at->diffForHumans();
    }

    public function getTheImageAttribute()
    {
        if (isset($this->image->filepath)) {
            return Storage::url($this->image->filepath);
        } else {
            return 'https://www.sylvansport.com/wp/wp-content/uploads/2018/11/image-placeholder-1200x800.jpg';
        }
    }

}
