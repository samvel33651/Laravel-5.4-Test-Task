@extends('layouts.app')


@section('content')
    <div class="col-md-4 col-sm-6 m-t-25" >
        <form method="POST" action="/vendors/add" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text"  class="form-control" id="name" name="name"  value="{{old('name')}}" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control-file" name="logo" id="logo">
            </div>
            <div class="imageContainer">

            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" style="width: 120px; margin-top: 25px;">Add</button>
            </div>

            <div class="form-group">
                @include('layouts.errors')
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/imgUploader.js') }}"></script>
@endsection