<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Accessor for displaying the full path of an image

    public function getFeaturedAttribute($featured)
    {
       return asset($featured); 
    }
  
    protected $dates = ['deleted_at'];
}
