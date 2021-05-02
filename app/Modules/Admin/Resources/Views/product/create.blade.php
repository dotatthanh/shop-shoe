@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-product" action="{{ route('admin.product.store') }}" method="POST" novalidate>
                @include('admin::product._form', ['routeType' => 'create'])
            </form>
        </div>
    </div>
@endsection