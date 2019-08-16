<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'from', 'to', 'text', 'read'
    ];

    public function getTheFormattedTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
