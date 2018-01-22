@extends('layouts.app')

@section('content')
    <h2 class="inline">Manage Users </h2>

    <div class="table-responsive">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>UserName</th>
                <th>Email</th>
                <th>IsAdmin</th>
                <th>IsActive</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->isAdmin)
                            <input class="isAdmin" data-id="{{$user->id}}" type="checkbox" checked data-toggle="toggle">
                        @else
                            <input class="isAdmin" data-id="{{$user->id}}" type="checkbox"  data-toggle="toggle">
                        @endif
                    </td>
                    <td>
                        @if($user->isActive)
                            <input class="isActive" data-id="{{$user->id}}" type="checkbox" checked data-toggle="toggle">
                        @else
                            <input class="isActive" data-id="{{$user->id}}" type="checkbox"  data-toggle="toggle">
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-success" href="/users/add">Add new user</a>
    </div>
@endsection

@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection