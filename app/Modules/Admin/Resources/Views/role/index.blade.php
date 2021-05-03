@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Vai trò
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Vai trò</li>
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
                            <form action="{{ route('admin.role.index') }}" method="GET" class="form-horizontal">
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
                            <a href="{{ route('admin.role.create') }}" class="btn btn-success">
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
                                    <th>Vai trò</th>
                                    <th>Quyền hạn</th>
                                    <th style="min-width: 100px">Ngày tạo</th>
                                    <th style="min-width: 155px">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <span>{{ $role->name }}</span>
                                    </td>

                                    @php
                                        $listPermission = $role->permissions()->pluck('name')
                                    @endphp
                                    <td>
                                        @if ($role->name === 'admin')
                                            <span class="badge text-white" style="background: #7f29ab;">all permission</span>
                                        @else
                                            @foreach ($listPermission as $value)
                                                <span class="badge text-white" style="background: #7f29ab;">{{ $value }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($role->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-warning pull-left" style="margin-right: 3px;">
                                            <span>Sửa</span>
                                        </a>
                                        @if (!($role->name == 'admin'))
                                            <a href="{{ route('admin.role.destroy', $role->id) }}">
                                                <button class="btn btn-danger">
                                                    <span>Xóa</span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $roles->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
