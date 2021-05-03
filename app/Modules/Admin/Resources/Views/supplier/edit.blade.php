@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-product" action="{{ route('admin.suppliers.update', $dataEdit->id) }}" method="POST" novalidate>
            	@csrf
            	@method('PUT')
                @include('admin::supplier._form', ['routeType' => 'edit'])
            </form>
        </div>
    </div>
@endsection