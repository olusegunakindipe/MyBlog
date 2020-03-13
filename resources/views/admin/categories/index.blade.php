@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('category.create')}}" class="btn btn-success"> Add Category</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Categories</h4>
        </div>
        <div class="card-body">
            @if($categories->count()>0)
                <table class="table table-hover">
                    <thead>
                        <th> Category Name</th>
                        <th> Edit </th>
                        <th> Delete </th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                    
                            <td>
                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-xs btn-info"> 
                                    Edit
                                </a>
                            </td> 
                            <td>
                                <form action="{{route('category.destroy', $category->id)}}" method="POST">
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
                <h2 class="text-center"> No Published Category</h2>
            @endif
        </div>
    </div>
@stop