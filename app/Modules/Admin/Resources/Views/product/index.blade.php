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
                                <div class="box-body row">
                                    <div class="form-group">
                                        <div class="col-md-3" style="padding-right: 5px">
                                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, slug" value="{{ request()->search }}">
                                        </div>
                                        <div class="col-md-2" style="padding-right: 5px; padding-left: 5px">
                                            <input type="text" name="price_min" class="form-control" placeholder="Giá nhỏ nhất" value="{{ request()->price_min }}">
                                        </div>
                                        <div class="col-md-2" style="padding-right: 5px; padding-left: 5px">
                                            <input type="text" name="price_max" class="form-control" placeholder="Giá lớn nhất" value="{{ request()->price_max }}">
                                        </div>
                                        <div class="col-md-3" style="padding-left: 5px">
                                            <select name="status" id="" class="form-control" value="{{ request()->status }}">
                                                <option value="">--Kiểm tra hàng--</option>
                                                <option value="1" @if(request()->status == 1) selected @endif>Còn hàng</option>
                                                <option value="0" @if(request()->status != null && request()->status == 0) selected @endif>Hết hàng</option>
                                            </select>
                                        </div>
        
                                        <button type="submit" class="btn btn-success col-md-2">Tìm kiếm</button>
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
                                    <th>Kích cỡ</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Giá KM</th>
                                    <th>Nổi bật</th>
                                    <th>Mới về</th>
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
                                        <td>{{ number_format($product->price) }} VNĐ</td>
                                        <td>{{ number_format($product->sale_price) }} VNĐ</td>
                                        <td>
                                            @if ($product->is_hot === PRODUCT_HOT)
                                                <label class="label label-success">Có</label>
                                            @else
                                                <label class="label label-default">Không</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->is_new === NEW_PRODUCT)
                                                <label class="label label-success">Có</label>
                                            @else
                                                <label class="label label-default">Không</label>
                                            @endif
                                        </td>
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
                        {{ $products->appends(['search' => $search ?? null])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection