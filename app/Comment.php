<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function story()
    {
        return $this->belongsTo('App\Story');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function gettheCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
