@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('tag.create')}}" class="btn btn-success"> Add Tag</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Tags</h4>
        </div>
        <div class="card-body">
            @if($tags->count()>0)
                <table class="table table-hover">
                    <thead>
                        <th> Tag Name</th>
                        <th> Edit </th>
                        <th> Delete </th>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->tag}}</td>
                    
                            <td>
                                <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-xs btn-info"> 
                                    Edit
                                </a>
                            </td> 
                            <td>
                                <form action="{{route('tag.destroy', $tag->id)}}" method="POST">
                                    @csrf
                                    @Method('DELETE')
                                    <button class="btn btn-xs btn-danger"> 
                                        Delete
                                    </button>
                                </form>  
                            </td>       
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <h2 class="text-center"> No available Tag</h2>
            @endif
        </div>
    </div>
@stop