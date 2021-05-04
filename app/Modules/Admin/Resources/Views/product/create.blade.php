@extends('admin::layouts.master')

@section('content')
    <form class="form-product" action="{{ route('admin.product.store') }}" method="POST" novalidate>
    	@csrf
        @include('admin::product._form', ['routeType' => 'create'])
    </form>
@endsection