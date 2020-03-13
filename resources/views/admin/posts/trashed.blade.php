@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('post.create')}}" class="btn btn-success"> Add Post</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Trashed Posts</h4>
        </div>
        <div class="card-body">
            @if($posts->count() >0)
                <table class="table table-hover">
                    <thead>
                        <th> Image</th>
                        <th> Post Title</th>
                        <th> Restore </th>
                        <th> Destroy </th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td><img src="{{ $post->featured}}" style="height: 50px; width: 50px"></td>

                                <td>{{$post->title}}</td>
                            
                                <td> 
                                    <a href="{{route('post.restore', $post->id)}}" class="btn btn-xs btn-info"> 
                                        Restore
                                    </a>
                                </td>
                            
                                <td>
                                    <form action="{{route('post.kill', $post->id)}}" method="POST">
                                        @csrf
                                        @Method('DELETE')
                                        <button class="btn btn-xs btn-danger"> 
                                            Destroy
                                        </button>
                                    </form>  
                                </td>
                            </tr>
                    
                        @endforeach
                    </tbody>

                </table>
                @else
                    <h2 class="text-center"> No Trashed Posts </h2>   
            @endif
        </div>
    </div>
@stop