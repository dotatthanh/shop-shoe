@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Mã giảm giá
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.discount_code.index') }}">Mã giảm giá</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-discount-code" action="{{ route('admin.discount_code.store') }}" method="POST" novalidate>
        @include('admin::discount_code._form', ['routeType' => 'create'])
    </form>
@endsection