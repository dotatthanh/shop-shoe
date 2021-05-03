@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-product" action="{{ route('admin.categories.update', $dataEdit->id) }}" method="POST" novalidate>
            	@csrf
            	@method('PUT')
                @include('admin::category._form', ['routeType' => 'edit'])
            </form>
        </div>
    </div>
@endsection