@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Nhà cung cấp
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.suppliers.index') }}">Nhà cung cấp</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-product" action="{{ route('admin.suppliers.store') }}" method="POST" novalidate>
        @csrf
        @include('admin::supplier._form', ['routeType' => 'create'])
    </form>
@endsection