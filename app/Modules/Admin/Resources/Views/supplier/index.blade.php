@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.suppliers.index') }}" method="GET" class="form-horizontal">
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
                            <a href="{{ route('admin.suppliers.create') }}" class="btn btn-success">
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id }}</td>
                                    <td>{{ $supplier->title }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-warning text-white">Sửa</a>
                                        <form class="d-inline-block" method="POST" action="{{ route('admin.suppliers.destroy', $supplier->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-60px btn btn-danger" type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $suppliers->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection