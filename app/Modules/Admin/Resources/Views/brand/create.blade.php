@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Thương hiệu
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-product" action="{{ route('admin.brands.store') }}" method="POST" novalidate>
        @csrf
        @include('admin::brand._form', ['routeType' => 'create'])
    </form>
@endsection