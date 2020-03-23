@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
           {{isset($category) ? 'Edit Category' :  'Create new category'}}
        </div>
        <div class="card-body">
        @include('partials.errors')

            <form action="{{isset($category) ? route('category.update', $category->id) : route('category.store')}}" method="post">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title"> Name</label>
                    <input type="text" name="name" class="form-control" value="{{isset($category) ? $category->name : ''}}">
                </div>
                
                
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">{{isset($category) ?' Update Category':'Store Category'}}</button>
                </div>
            </form>

        </div>
    </div>
@stop