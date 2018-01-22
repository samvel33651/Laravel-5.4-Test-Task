@extends('layouts.app')

@section('content')
    <h2 style="display: inline-block">Vendors </h2>
    @if(auth()->user()->isAdmin === 0)
        <a class="btn btn-primary" style="display: inline-block; float: right; margin-top: 22px; margin-right: 30px;
        " href="/vendors/add">Add a new vendor</a>
    @endif

    <hr>
    <div class="row">
        <div class="">
            @if(count($vendors) > 0)
                @foreach($vendors as $vendor)
                    <div class="col-md-3">
                        <div class="product-item" style="min-height: 273px;">
                            <div class="pi-img-wrapper">
                                <img src="/img/uploads/vendors/{{$vendor->logo}}" class="img-responsive" alt="">
                            </div>
                            <h3>{{$vendor->name}}</h3>

                            <div class="bot" style="    position: absolute; bottom: 10px; width: 260px;">
                                <a href="/vendors/{{$vendor->id}}/edit" class="btn btn-primary" style="width:50%; display: inline-block; float: left">
                                    <i class="fa fa-pencil  " aria-hidden="true"></i>
                                    Edit
                                </a>
                                <a href="/vendors/{{$vendor->id}}/delete" class="btn btn-primary" style="width:50%;"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-form_{{$vendor->id}}').submit();">
                                    <i class="fa fa-trash-o " aria-hidden="true"></i>
                                    Delete
                                </a>
                                <form id="delete-form_{{$vendor->id}}" action="/vendors/{{$vendor->id}}/delete" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="m-t-35">No results to show !!!</h1>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection