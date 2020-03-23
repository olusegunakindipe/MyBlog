@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('user.create')}}" class="btn btn-success"> Add User</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Users</h4>
        </div>
        <div class="card-body">
            @if($users->count()>0)
                <table class="table table-hover">
                    <thead>
                        <th>Image </th>
                        <th> User Name</th>
                        <th> Permission </th>
                        <th>Edit User</th>
                        <th> Delete </th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><img src="{{asset($user->profile->avatar)}}"  width="40px" height="40px" border-radius="50%"></td>
                                <td>{{$user->name}}</td>
                                <td>
                                @if(Auth::id() !== $user->id)
                                    @if($user->admin)
                                    
                                        <a href="{{route('user.notadmin', $user->id)}}" class="btn btn-danger btn-sm">Remove as Admin</a>         
                                    @else
                                        <a href="{{route('user.admin', $user->id)}}" class="btn btn-info btn-sm">Make Admin</a>
                                    @endif
                                @else
                                Main Admin
                                @endif
                                </td>

                                <td>
                                @if(Auth::id() == $user->id)
                                    <a href="{{route('user.profile.edit', $user->id)}}" class="btn btn-info btn-sm"> Edit Profile</a>
                                @endif
                                </td> 
                                <td>
                                @if(Auth::id() !== $user->id)
                                    <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                        @csrf
                                        @Method('DELETE')
                                        <button class="btn btn-sm btn-danger"> 
                                            Trash
                                        </button>
                                    </form>  
                                </td> 
                            @endif      
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <h2 class="text-center"> No User</h2>
            @endif
        </div>
    </div>
@stop