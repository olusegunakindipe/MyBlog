<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\Category;
use Auth;
use File;
use Illuminate\Support\Str;
use App\Http\Requests\CreatePostRequest;

use Session;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        if($categories->count() == 0){

            Session::flash('info', 'You must create a category before you create a post');
            return redirect()->back();
        }
        if($tags->count() == 0){

            Session::flash('info', 'You must create a tag before you create a post');
            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories)
                                         -> with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
       
        $featured = $request->featured; //get the request image

        $featured_new = time().$featured->getClientOriginalName();// give the picture a new name
        
        $featured->move('uploads/posts', $featured_new); //move the new file to the position

       //using another method to store data in the database
    //Note- This u=is generate mass assignment problem
        $post = Post::create([
           'title' => $request->title,
           'featured' => 'uploads/posts/'.$featured_new,
           'content' => $request->content,
           'category_id'=>$request->category_id,
           'slug'=>Str::slug($request->title),
           'user_id' => Auth::id()
       ]);
       
        // This can be used if we dont want mass assignment --------------------------------------
        // $post = new Post;
        // $post->title = $request->title;
        // $post->featured = $request->featured;
        // $post->content = $request->content;
        // $post->category_id = $request->category_id;

        $post->tags()->attach($request->tags); //the tag() is the many to many relationship
        $post->save();
        Session::flash('success', 'You successfully created a post');
        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.create')
        ->with('post', $post)
        ->with('tags', Tag::all())
        ->with('categories', Category::all())

        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        
        $previousImage = parse_url($post->featured);
        $path =$previousImage['path'];

        if($request->hasFile('featured')){ //check if a file with the filename is uploaded           $featured = $request->featured; //assign the file to a variable

            $featured = $request->featured;
            $featured_new = time() . $featured->getClientOriginalName(); //assign a new name 
            
            $featured->move('uploads/posts', $featured_new); // move the file  with the new name to the directory

            $post->featured = 'uploads/posts/'.$featured_new;
       
           File::delete(public_path($path));
        }
 //steps in uploading a file
 
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->tags()->sync($request->tags);

        $post->save();
        Session::flash('success', 'You successfully updated a post');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', 'You successfully Trashed a post. Check Trashed to restore');

        return redirect()->route('post.index');
    }

    public function trashed()
    {
    
        $post = Post::onlyTrashed()->get();
        
        return view('admin.posts.trashed')->with('posts',$post);
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        Session::flash('success', 'The post has been permanently deleted');
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        Session::flash('success', 'The post has been restored');
        return redirect()->back();
    }
}
