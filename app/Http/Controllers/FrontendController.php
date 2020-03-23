<?php

namespace App\Http\Controllers;
use App\Setting;
use App\Category;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {   
        return view('index')->with('title', Setting::first()->site_name)
                            ->with('categories', Category::take(5)->get())
                            ->with('first_post', Post::latest()->first())// This is the same as Post::orderBy('created_at', 'desc')->first()
                            ->with('second_post', Post::latest()->skip(1)->take(1)->get()->first())
                            ->with('third_post', Post::latest()->skip(2)->take(1)->get()->first())
                            ->with('religion', Category::find(1))
                            ->with('technology', Category::find(2))
                            ->with('setting', Setting::first());
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $next= Post::where('id', '>', $post->id)->min('id');
        $prev= Post::where('id', '<', $post->id)->max('id');

        return view('singlePost')->with('post', $post)
                            ->with('title', $post->title)
                            ->with('categories', Category::take(7)->get())
                            ->with('setting', Setting::first())
                            ->with('tags', Tag::all())
                            ->with('next', Post::find($next))
                            ->with('prev', Post::find($prev));
    }

    public function singleCategory( Category $category)
    {

        return view('singleCategory')->with('category', $category)
                                    ->with('title', $category->name)
                                    ->with('tags', Tag::all())
                                    ->with('categories', Category::take(5)->get())
                                    ->with('setting', Setting::first());
    }

    public function singleTag(Tag $tag)
    {
        return view('singleTag')->with('tag',$tag)
                                ->with('title', $tag->name)
                                ->with('tags', Tag::all())
                                ->with('categories', Category::take(5)->get())
                                ->with('setting', Setting::first());
    }

    public function result(Request $request)
    {
        $search = $request->query;
        $query = $search->all('query')['query'];
        $posts = Post::where('title','like', '%'.$query.'%')->get();

        return view('results')->with('posts', $posts)
                                ->with('title','Search Result :'.$query)
                                ->with('categories', Category::take(5)->get())
                                ->with('setting', Setting::first())
                                ->with('tags', Tag::all())
                                ->with('query', $query);
    }
}
