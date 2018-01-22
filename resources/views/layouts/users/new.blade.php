@extends('layouts.app')

@section('content')
    <div class="col-md-4 col-sm-6">
        <form method="POST" action="/users/add">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">UserName :</label>
                <input type="text"  class="form-control" id="name" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password confirmation:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="isAdmin">User Roll:</label>
                <select class="form-control" id="isAdmin" name="isAdmin">
                    <option value="1">Admin user</option>
                    <option value="0">Regular user</option>

                </select>
            </div>
            <div class="form-group">
                <label for="isActive">IsActive:</label>
                <input id="isActive"  type="radio" name="isActive">
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Save user</button>
            </div>

            <div class="form-group">
                @include('layouts.errors')
            </div>
        </form>
    </div>
@endsection