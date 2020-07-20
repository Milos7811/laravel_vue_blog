<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    protected $fillable = [
        'text', 'post_id', 'user_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function images()
    {
        return $this->hasMany('App\CommentImage');
    }
    public function comment_image()
    {
        return $this->hasMany('App\CommentImage');
    }
};
