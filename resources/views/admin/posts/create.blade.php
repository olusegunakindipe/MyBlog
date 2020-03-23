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
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach($tags as $tag)
                    <div class="checkbox">
                        <label> <input type="checkbox" name='tags[]' value="{{$tag->id}}"
                        @if(isset($post))
                            @foreach($post->tags as $postags)
                                @if($tag->id == $postags->id)
                                    checked
                                @endif
                            @endforeach
                        @endif
                        >{{$tag->tag}}</label>
                    </div>
                    @endforeach
                </div>
                
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{isset($post)? $post->content: '' }}">
                    <trix-editor input="content"></trix-editor>                
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success"> {{isset($post) ? 'Update Post' : 'Store Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix-core.js"></script>


@endsection