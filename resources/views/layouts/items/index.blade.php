@extends('layouts.app')

@section('content')
    <div  style="width: 500px; margin: 25px auto; ">
        <form action="/search" method="GET" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="keyword"
                       placeholder="Search"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <h2 style="display: inline-block">My items</h2>
    @if(auth()->user()->isAdmin ==0)
        <a class="btn btn-primary" style="
        display: inline-block;
        float: right;
        margin-top: 22px;
        margin-right: 30px;
    " href="/items/add">Add a new item</a>
    @endif
    <div class="row" id="itemsTable">
        @include('layouts.items.entry', ['items' => $items, 'isPost'=> false])
    </div>


@endsection

