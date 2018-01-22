@extends('layouts.app')

@section('content')
    <div class="col-md-4 col-sm-6">
        <form method="POST" action="/types/add">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text"  class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Save type</button>
            </div>

            <div class="form-group">
                @include('layouts.errors')
            </div>
        </form>
    </div>
@endsection