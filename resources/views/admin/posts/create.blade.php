@extends('layouts.app')

@section('content')

    
    <div class="card">
        <div class="card-header">
            {{isset($post) ? 'Edit Post' : 'Create new post'}}
        </div>
        <div class="card-body">
        @include('partials.errors')
            <form action="{{isset($post)? route('post.update', $post->id) : route('post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @Method('PUT')
                @endif
                <div class="form-group">
                    <label for="title"> Title</label>
                    <input type="text" name="title" class="form-control" value="{{isset($post) ? $post->title : ''}}">
                </div>
                <div class="form-group">
                    <label for="featured"> Featured Image</label>
                    <input type="file" name="featured" class="form-control">
                </div>

                
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                            @if(isset($post))
                                @if($category->id == $post->category_id)
                                    selected
                                @endif
                            @endif
                            >
                            {{$category->name}}</option>
                        @endforeach

                    </select>
                </div>

                
                <div class="form-group">
                    <label for="title"> Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{isset($post) ? $post->content : ''}}</textarea>
                </div>


                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success"> {{isset($post) ? 'Update Post' : 'Store Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection