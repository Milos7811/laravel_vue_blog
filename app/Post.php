<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Post extends Model
{
    use CascadesDeletes;

    protected $cascadeDeletes = ['comments', 'images'];

    protected $fillable = [
        'title', 'slug', 'text', 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    // Prepojenie modelu post z modelom user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }
    public function images()
    {
        return $this->hasMany('App\PostImage');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
