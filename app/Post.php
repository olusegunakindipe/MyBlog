<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{

    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('Category');
    }


    //Accessor for displaying the full path of an image

    public function getFeaturedAttribute($featured)
    {
       return asset($featured); 
    }

    protected $dates = ['deleted_at'];
}
