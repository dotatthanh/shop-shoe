@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Thành viên 
            <small>Cập nhật</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.member.index') }}">Thành viên</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>
@endsection

@section('content')
    <form class="row" action="{{ route('admin.member.update', $user->id) }}" method="post">
        @csrf
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                        {!! $errors->first('username', '<span class="help-block error">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                    </div>

                    <div class='form-group'>
                        <p class="mr-3">Vai trò</p>
                        <select 
                            name="roles[]" 
                            id="addRole" 
                            class="select2Role form-control"
                            multiple
                        >
                        @foreach ($roles as $item)
                            <option 
                            @if (in_array($item->id, $user->roles->pluck('id')->toArray()))
                                selected
                            @endif
                            value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach        
                    </select>
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                        {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    @include('admin::includes.form-action', ['routeIndex' => route('admin.member.index')])
                </div>
            </div>
        </div>
    </form>
@endsection
