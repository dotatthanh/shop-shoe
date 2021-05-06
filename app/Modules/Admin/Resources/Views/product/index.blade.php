@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Sản phẩm 
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Sản phẩm</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.product.index') }}" method="GET" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, slug, giá bán" value="{{ request()->search }}">
                                        </div>
        
                                        <button type="submit" class="btn btn-success col-sm-2">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                <span>Tạo mới</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Giá KM</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image)
                                                <div class="product-logo">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="w-100 h-100">
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>
                                            @foreach ($product->product_categories as $category)
                                                <p>{{ $category->category->title }}</p>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->brand->title }}</td>
                                        <td>{{ $product->supplier->title }}</td>
                                        <td>
                                            @foreach ($product->sizes as $item)
                                                <p>{{ $item->name }}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->sizes as $item)
                                                <p>{{ $item->quantity }}</p>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->price }} VNĐ</td>
                                        <td>{{ $product->sale_price }} VNĐ</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning text-white">Sửa</a>
                                            <form class="d-inline-block" method="POST" action="{{ route('admin.product.delete', $product->id) }}">
                                                @csrf
                                                <button class="w-60px btn btn-danger" type="submit">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection