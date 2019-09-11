<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialMediaLink extends Model
{
    protected $table = 'user_socialmedia_links';
    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
