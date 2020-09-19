<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deletd_at'];

    protected $fillable = ['post_title', 'post_content', 'image_path', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function setPostTitleAttribute($value)
    {
        $this->attributes['post_title'] = strtoupper($value);
    }

    public function scopeCustomLatest($query)
    {
        return $query->orderBy('id', 'desc')->get();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
