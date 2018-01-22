@extends('layouts.app')


@section('content')
    <h2 class="inline">Types</h2>

    <div class="table-responsive col-md-5">

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($types as $type)

                <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->name}}</td>
                    <td>
                        <a href="/types/{{$type->id}}/edit"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                        <a href="/types/{{$type->id}}/delete"
                           onclick="event.preventDefault();
                                                     document.getElementById('delete-form_{{$type->id}}').submit();">
                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                        </a>

                        <form id="delete-form_{{$type->id}}" action="/types/{{$type->id}}/delete" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-success" href="/types/add">Add new type</a>
    </div>
@endsection