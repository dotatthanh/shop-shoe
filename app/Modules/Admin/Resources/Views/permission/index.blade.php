@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Quyền hạn
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quyền hạn</li>
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
                            <form action="{{ route('admin.permission.index') }}" method="GET" class="form-horizontal">
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
                            <a href="{{ route('admin.permission.create') }}" class="btn btn-success">
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
                                    <th>Tên</th>
                                    <th style="min-width: 100px">Ngày tạo</th>
                                    <th style="min-width: 155px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <span>{{ $item->name }}</span>    
                                    </td> 
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('admin.permission.edit', $item->id) }}" class="btn btn-warning pull-left" style="margin-right: 3px;">
                                            <span>Sửa</span>
                                        </a>
                
                                        <a href="{{ route('admin.permission.destroy', $item->id) }}">
                                            <button class="btn btn-danger">
                                                <span>Xóa</span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection