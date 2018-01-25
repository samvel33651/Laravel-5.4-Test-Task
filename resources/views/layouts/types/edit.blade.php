@extends('layouts.app')

@section('content')
    <div class="col-md-4 col-sm-6">
        <form method="POST" action="/types/{{$type->id}}/edit">
            {{ method_field('PUT') }}
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text"  class="form-control" id="name" name="name" placeholder="{{$type->name}}" value="{{old('name')}}" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit" style="width: 120px;">Update</button>
            </div>

            <div class="form-group">
                @include('layouts.errors')
            </div>
        </form>
    </div>
@endsection