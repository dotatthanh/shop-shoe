@extends('admin::layouts.master')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Đơn hàng
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Đơn hàng</li>
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
                            <form action="{{ route('admin.order.index') }}" method="GET" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <input type="text" name="search" class="form-control" placeholder="Từ khóa" value="{{ request()->search }}">
                                        </div>
        
                                        <button type="submit" class="btn btn-success col-sm-2">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="col-md-6 text-right">
                            <a href="{{ route('admin.order.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                <span>Tạo mới</span>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th style="min-width: 100px">Ngày tạo</th>
                                    <th style="min-width: 155px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td> 
                                    <td>{{ $item->user->phone }}</td> 
                                    <td>{{ $item->user->address }}</td> 
                                    <td>
                                        @if (isset($item->order_products))
                                            @foreach ($item->order_products as $order)
                                                <a href="{{ route('user.product-detail', ['slug' => $order->product->slug, 'id' => $order->product->id]) }}" target="_blank">{{ $order->product->title }}</a>
                                                <p>(Kích cỡ: {{ $order->size_name }})</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->total) }} VNĐ</td>
                                    <td>
                                        @if ($item->status === 'order')
                                            <label class="label label-warning change-status-order" data-id="{{ $item->id }}" data-status="delivery">Đặt hàng</label>
                                        @endif
                                        @if ($item->status === 'delivery')
                                            <label class="label label-primary change-status-order" data-id="{{ $item->id }}" data-status="complete">Đang vận chuyển</label>
                                        @endif
                                        @if ($item->status === 'complete')
                                            <label class="label label-success" data-id="{{ $item->id }}" data-status="order">Hoàn thành</label>
                                        @endif
                                        @if ($item->status === 'cancel')
                                            <label class="label label-danger">Đã hủy</label>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        @if ($item->status !== 'cancel' && $item->status !== 'complete')
                                            <form class="d-inline-block" method="POST" action="{{ route('admin.order.cancel', $item->id) }}">
                                                @csrf
                                                <button class="w-60px btn btn-warning" type="submit">Hủy đơn</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
        $('.change-status-order').on('click', function () {
            let orderId = $(this).data('id');
            let status = $(this).data('status');
            $.ajax({
                url: '/admin/change-status-order/' + orderId,
                method: 'post',
                data: {
                    'status': status,
                },
                success: function (response) {
                    if (response.code === 200) {
                        Toast.fire({
                            icon: 'success',
                            title: "Cập nhật trạng thái đơn hàng thành công!"
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>
@endsection