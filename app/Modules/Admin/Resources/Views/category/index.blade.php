@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Danh mục 
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh mục</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.categories.index') }}" method="GET" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <input type="text" name="search" class="form-control" placeholder="Từ khóa" value="{{ request()->search }}">
                                        </div>

                                        <button type="submit" class="btn btn-success col-sm-2">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                <span>Tạo mới</span>
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
                                    <th>Tiêu đề</th>
                                    <th>Slug</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning text-white">Sửa</a>
                                        <form class="d-inline-block" method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-60px btn btn-danger" type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection