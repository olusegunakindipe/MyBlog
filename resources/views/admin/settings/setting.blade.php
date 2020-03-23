@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
           <h3>WebPage Settings</h2>
        </div>
        <div class="card-body">
        @include('partials.errors')

            <form action="{{route('settings.update')}}" method="Post">
                @csrf
    
                <div class="form-group">
                    <label for="title"> Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $setting->site_name}}">
                </div>
                <div class="form-group">
                    <label for="title"> Email</label>
                    <input type="email" name="email" class="form-control" value="{{$setting->email}}">
                </div>
                <div class="form-group">
                    <label for="image">  Phone Number</label>
                    <input type="tel" name="phone_number" class="form-control" value="{{ $setting->phone_number}}">
                </div>

                <div class="form-group">
                    <label for="image">  Address</label>
                    <input type="text" name="address" class="form-control" value="{{$setting->address}}">
                </div>
                <div class="form-group">
                    <label for="youtube"> About </label>
                    <textarea name="about" id="about" cols="5" rows="5"  class="form-control">{{ $setting->about}}</textarea>
                </div>
               
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success"> Update Settings </button>
                </div>
            </form>

        </div>
    </div>
@endsection

