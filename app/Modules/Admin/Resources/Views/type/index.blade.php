@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.types.index') }}" method="GET" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <input type="text" name="search" class="form-control" placeholder="Title">
                                        </div>

                                        <button type="submit" class="btn btn-success col-sm-2">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.types.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                <span>Create</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->title }}</td>
                                    <td>{{ $type->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning text-white">Sửa</a>
                                        <form class="d-inline-block" method="POST" action="{{ route('admin.types.destroy', $type->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-60px btn btn-danger" type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $types->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection