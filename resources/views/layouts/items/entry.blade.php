@if($items->count())
    <table class="table table-bordered">
        <tr>
            <th  class="sort">@sortablelink('item_name', 'name')</th>
            <th  class="sort">@sortablelink('type.name', 'type')</th>
            <th  class="sort">@sortablelink('vendor.name', 'vendor')</th>
            <th  class="sort">@sortablelink('price')</th>
            <th  class="sort">@sortablelink('weight')</th>
            <th  class="sort">@sortablelink('color')</th>
            <th  class="sort">@sortablelink('release_date')</th>
            <th  class="sort">Tags</th>
            <th  class="sort">Photo</th>
            <th  class="sort">Actions</th>
        </tr>

        @foreach($items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->type()->value('name') }}</td>
                <td>{{ $item->vendor()->value('name') }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->color }}</td>
                <td>{{Carbon\Carbon::parse($item->release_date)->toFormattedDateString()}}</td>
                <td>
                    <div class="item-content-block tags">
                        @foreach(explode(',', $item->tags) as $tag)
                            <a>{{$tag}}</a>
                        @endforeach

                    </div>
                </td>
                <td><img src="/img/uploads/items/{{$item->photo}}" alt="" width="" class="img-responsive"></td>
                <td>
                    <a href="/items/{{$item->id}}/edit" class="btn btn-primary"
                       style="width:50%; display: inline-block; float: left">
                        <i class="fa fa-pencil  " aria-hidden="true"></i>
                        Edit
                    </a>
                    <a href="/items/{{$item->id}}/delete" class="btn btn-primary" style="width:50%;"
                       onclick="event.preventDefault();
                               document.getElementById('delete-form_{{$item->id}}').submit();">
                        <i class="fa fa-trash-o " aria-hidden="true"></i>
                        Delete
                    </a>
                    <form id="delete-form_{{$item->id}}" action="/items/{{$item->id}}/delete" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {!! $items->appends(\Request::except('page'))->render() !!}
@else
    <h1 class="m-t-35">No results to show !!!</h1>
@endif
@if(!$isPost)

@section('scripts')
    <script src="{{ asset('js/paginationAjax.js') }}"></script>

@endsection

@endif
