@extends('layouts.user')
@section('body')
<div class="container">
    <div class="row">
    @if(isset($userEditInfo)) 
        <div class="col-md-8">
    @else
        <div class="col-md-12">
    @endif
            <div class="well">
                <h4> Your Profile</h4>
                <table class="table-edit" >
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                            <a href="{{route('profile_edit_user',$user->id)}}" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>E</a>
                            <!-- <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('profile_delete_user',$user->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a> -->
                            </td>
                        </tr>
                    @endforeach                               
                </table>
            </div>
            <div class="text-center">
            {{ $users->links() }}
            </div>
        </div>
        @if(isset($userEditInfo)) 
        <div class="col-md-4">
            <div class="well">
                <h4>Edit Your Profile</h4>
                <form action="{{ route ('profile_update_user',['id'=>$userEditInfo->id]) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name"  @if(isset($userEditInfo)) value='{{$userEditInfo->name}}' @endif>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" id="email"  @if(isset($userEditInfo)) value='{{$userEditInfo->email}}' @endif>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-default">Update Profile </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection