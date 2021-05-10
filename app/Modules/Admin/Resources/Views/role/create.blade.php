@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Vai trò 
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.role.index') }}">Vai trò</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="row" action="{{ route('admin.role.store') }}" method="post">
        @csrf
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    @include('admin::includes.form-action', ['routeIndex' => route('admin.role.index')])
                </div>
            </div>
        </div>
    </form>
@endsection
