@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
           {{isset($user) ? 'Edit User Profile' :  'Create new user'}}
        </div>
        <div class="card-body">
        @include('partials.errors')

            <form action="{{isset($user) ? route('user.update', $user->id) : route('user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title"> Name</label>
                    <input type="text" name="name" class="form-control" value="{{isset($user) ? $user->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="title"> Email</label>
                    <input type="email" name="email" class="form-control" value="{{isset($user) ? $user->email : ''}}">
                </div>
                <div class="form-group">
                    <label for="password">  New Password</label>
                    <input type="password" name="password" class="form-control" value="{{isset($user) ? $user->password : ''}}">
                </div>

                <div class="form-group">
                    <label for="image">  Image</label>
                    <input type="file" name="avatar" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="facabook">  Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ isset($user) ? $user->profile->facebook : ''}}">
                </div> 
                <div class="form-group">
                    <label for="youtube"> Youtube </label>
                    <input type="text" name="youtube" class="form-control" value="{{ isset($user) ? $user->profile->youtube : ''}}">
                </div>
                <div class="form-group">
                    <label for="youtube"> About </label>
                    <textarea name="about" id="about" cols="5" rows="5"  class="form-control">{{ isset($user) ? $user->profile->about: ''}}</textarea>
                </div>
                
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">{{isset($user) ?' Update Profile':'Store User'}}</button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudfare.com/ajax/libs/summernote/0.8.2/summernote.js">

    $(document).ready(function(){
        $('content').summernote();
    });
</script>
@endsection