@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card text-center  border-info">
                <h4 class="card-header  border-info">POSTED</h4>
                <h2 class="card-body">{{$posts->count()}}</h2> 
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center border-info">
                <h5 class="card-header  border-info">CATEGORIES</h5>
                <h2 class="card-body">{{$categories->count()}}</h2> 
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center  border-danger">
                <h5 class="card-header  border-danger">TRASH POST</h5>
                <h2 class="card-body">{{$trashed->count()}}</h2> 
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center  border-info">
                <h4 class="card-header  border-info">USERS</h4>
                <h2 class="card-body">{{$users->count()}}</h2> 
            </div>
        </div>
    </div>
@endsection
