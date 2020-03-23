@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Trashed Users</h4>
        </div>
        <div class="card-body">
            @if($users->count() >0)
                <table class="table table-hover">
                    <thead>
                        <th> Image</th>
                        <th> User Name</th>
                        <th> Restore </th>
                        <th> Destroy </th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><img src="{{$user->profile->avatar}}" style="height: 50px; width: 50px"></td>

                                <td>{{$user->name}}</td>
                            
                                <td> 
                                    <a href="{{route('user.restore', $user->id)}}" class="btn btn-xs btn-info"> 
                                        Restore
                                    </a>
                                </td>
                            
                                <td>
                                    <form action="{{route('user.kill', $user->id)}}" method="POST">
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
                    <h2 class="text-center"> No Trashed User </h2>   
            @endif
        </div>
    </div>
@stop