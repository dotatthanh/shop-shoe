@extends('user::layouts.master')

@section('content')
    <div class="container" style="margin-top: 30px">
        <form class="row" method="post" action="{{ route('profile.update') }}">
            @csrf
            <div class="col-md-12">
                <b>CẬP NHẬT THÔNG TIN CÁ NHÂN</b>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" rows="5" value="{{ auth()->user()->address }}">{{ old('address', auth()->user()->address) }}</textarea>
                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
@endsection