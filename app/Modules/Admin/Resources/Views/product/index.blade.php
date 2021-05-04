@extends('admin::layouts.master')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6"></div>
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
                                            <p>M</p>
                                            <p>L</p>
                                        </td>
                                        <td>
                                            <p>1</p>
                                            <p>2</p>
                                        </td>
                                        <td>{{ $product->price }} VNĐ</td>
                                        <td>{{ $product->sale_price }} VNĐ</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning text-white">Sửa</a>
                                            <form class="d-inline-block" method="POST" action="{{ route('admin.product.destroy', $product->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="w-60px btn btn-danger" type="submit">Xóa</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection