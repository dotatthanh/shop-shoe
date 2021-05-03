@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-product" action="{{ route('admin.types.store') }}" method="POST" novalidate>
            	@csrf
                @include('admin::type._form', ['routeType' => 'create'])
            </form>
        </div>
    </div>
@endsection