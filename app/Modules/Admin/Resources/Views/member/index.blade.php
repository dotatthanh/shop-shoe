@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Thành viên
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Thành viên</li>
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
                            <form action="{{ route('admin.member.index') }}" method="GET" class="form-horizontal">
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
                            <a href="{{ route('admin.member.create') }}" class="btn btn-success">
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
                                    <th>Email</th>
                                    <th style="min-width: 100px">Ngày tạo</th>
                                    <th>Vai trò</th>
                                    <th style="min-width: 155px">Hành đồng</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                @foreach ($members as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>

                                    @php 
                                        $listRole = $item->roles()->pluck('name')
                                    @endphp
                                    <td>
                                        @foreach ($listRole as $value)
                                            <span class="badge badge-dark text-white">{{ $value }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.member.edit', $item->id) }}" class="btn btn-sm btn-warning pull-left" style="margin-right: 3px;">
                                            <span>Sửa</span>
                                        </a>
                                        <a href="{{ route('admin.member.destroy', $item->id) }}">
                                            <button class="btn btn-sm btn-danger">
                                                <span>Xóa</span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $members->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection