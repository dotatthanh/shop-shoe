@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Danh mục 
            <small>Tạo mới</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
            <li class="active">Tạo mới</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="form-product" action="{{ route('admin.categories.store') }}" method="POST" novalidate>
        @csrf
        @include('admin::category._form', ['routeType' => 'create'])
    </form>
@endsection