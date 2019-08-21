<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\StoryLike');
    }

    public function getTheLastUsersWhoPostedUsingThisCoin($take = 2)
    {
        $coins = $this->withTrashed()->where('coin_id', $this->coin_id)->latest()->take($take)->get();

        $users = $coins->map(function ($coin) {
            return  $coin->user;
        });

        return $users;
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

    public function getTheResizedImageAttribute()
    {
        if (isset($this->image->filepath)) {

            $filename = pathinfo(storage_path('app/' . $this->image->filepath), PATHINFO_FILENAME);
            $extension = pathinfo(storage_path('app/' . $this->image->filepath), PATHINFO_EXTENSION);

            if (File::exists(storage_path('app/public/story/images/' . $filename . '-497x290.' . $extension))) {
                return Storage::url('public/story/images/' . $filename . '-497x290.' . $extension);
            }

            return $this->theImage;
        } else {
            return 'https://www.sylvansport.com/wp/wp-content/uploads/2018/11/image-placeholder-1200x800.jpg';
        }
    }

}
