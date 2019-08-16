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
        'name', 'email', 'password', 'photo'
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

    public function stories()
    {
        return $this->hasMany('App\Story');
    }

    public function messages()
    {
        return Message::where('from_user_id', $this->id)->orWhere('to_user_id', $this->id)->get();
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

}
