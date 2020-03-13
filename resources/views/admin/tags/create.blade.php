@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
           {{isset($tag) ? 'Edit Tag' :  'Create new tag'}}
        </div>
        <div class="card-body">
        @include('partials.errors')

            <form action="{{isset($tag) ? route('tag.update', $tag->id) : route('tag.store')}}" method="post">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="tag"> Name</label>
                    <input type="text" name="tag" class="form-control" value="{{isset($tag) ? $tag->name : ''}}">
                </div>
                
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">{{isset($tag) ?' Update Tag':'Store Tag'}}</button>
                </div>
            </form>

        </div>
    </div>
@stop