@extends('layouts.app')

@section('content')
    <h2>Search Results for <strong>{{$keyword}}</strong></h2>
    <hr>
    <div class="row" id="itemsTable">
        @include('layouts.items.entry', ['items' => $items, 'isPost'=> false])
    </div>

    {{--@foreach($items as $item)

        <div class="col-md-3">
            <div class="thumbnail">
                <img src="/img/uploads/items/{{$item->photo}}" alt="" class="img-responsive">
                <div class="caption">
                    <h4 class="pull-right">{{$item->vendor()->value('name')}}</h4>
                    <h4>Vendor</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">{{$item->item_name}}</h4>
                    <h4>Model</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">{{$item->type()->value('name')}}</h4>
                    <h4>Type</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">{{$item->weight}}g</h4>
                    <h4>Weight</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">${{$item->price}}</h4>
                    <h4>Price</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">{{$item->color}}</h4>
                    <h4>Color</h4>
                </div>
                <div class="caption">
                    <h4 class="pull-right">{{Carbon\Carbon::parse($item->release_date)->toFormattedDateString()}}</h4>
                    <h4>Release date</h4>
                </div>
                <div class="item">
                    <div class="item-content-block tags">
                        @foreach(explode(',', $item->tags) as $tag)
                            <a>{{$tag}}</a>
                        @endforeach

                    </div>
                </div>

                <div class="space-ten"></div>
                <div class="btn-ground text-center">
                    <a href="/items/{{$item->id}}/edit" class="btn btn-primary" style="width:50%; display: inline-block; float: left">
                        <i class="fa fa-pencil  " aria-hidden="true"></i>
                        Edit
                    </a>
                    <a href="/items/{{$item->id}}/delete" class="btn btn-primary" style="width:50%;"
                       onclick="event.preventDefault();
                               document.getElementById('delete-form_{{$item->id}}').submit();">
                        <i class="fa fa-trash-o " aria-hidden="true"></i>
                        Delete
                    </a>
                    <form id="delete-form_{{$item->id}}" action="/items/{{$item->id}}/delete" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
                <div class="space-ten"></div>
            </div>
        </div>
    @endforeach--}}

@endsection
