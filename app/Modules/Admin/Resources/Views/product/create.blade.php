@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Sản phẩm 
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.product.index') }}">Sản phẩm</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-product" action="{{ route('admin.product.store') }}" method="POST" novalidate>
        @include('admin::product._form', ['routeType' => 'create'])
    </form>
@endsection