@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Thương hiệu
            <small>Cập nhật</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-product" action="{{ route('admin.brands.update', $dataEdit->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        @include('admin::brand._form', ['routeType' => 'edit'])
    </form>
@endsection