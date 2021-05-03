@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-product" action="{{ route('admin.brands.store') }}" method="POST" novalidate>
            	@csrf
                @include('admin::brand._form', ['routeType' => 'create'])
            </form>
        </div>
    </div>
@endsection