<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use App\Message;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'bio', 'email', 'password', 'photo', 'coverphoto', 'nickname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['thePhoto'];

    public function socialmedialinks()
    {
        return $this->hasOne(UserSocialMediaLink::class);
    }

    public function stories()
    {
        return $this->hasMany('App\Story');
    }

    public function likes()
    {
        return $this->hasMany('App\StoryLike');
    }

    public function likedTheStory($story_id)
    {
        $like = StoryLike::where('user_id', $this->id)->where('story_id', $story_id)->first();

        return $like;
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'id', 'from_user_id')->groupBy('to_user_id');
    }

    public function getLastMessage()
    {
        return Message::where('from_user_id', $this->id)->where('to_user_id', auth()->id())->latest()->first();
    }

    public function getThePhotoAttribute()
    {

        if ($this->photo) {
            return Storage::url($this->photo);
        } else {
            return 'http://fleischmen.com/wp-content/uploads/2017/11/user-avatar-placeholder.png';
        }

    }

    public function getTheCoverPhotoAttribute()
    {
        if ($this->coverphoto) {
            return Storage::url($this->coverphoto);
        } else {
            return 'http://fleischmen.com/wp-content/uploads/2017/11/user-avatar-placeholder.png';
        }
    }

    public function getFullName()
    {
        if (null == $this->first_name && null == $this->last_name) {
            return $this->nickname;
        } else {
            return $this->first_name . ' ' . $this->last_name;
        }
    }

}
