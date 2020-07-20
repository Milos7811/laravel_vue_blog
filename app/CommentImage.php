<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentImage extends Model
{

    protected $fillable = ['comment_id', 'comment_image_path', 'comment_image_caption'];


    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
