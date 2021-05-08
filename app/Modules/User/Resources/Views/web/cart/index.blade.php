@extends('user::layouts.master')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row" style="min-height: 350px">
            <div class="col-md-12">
                <b style="margin-bottom: 30px">GIỎ HÀNG CỦA BẠN</b>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th style="text-align: right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('user::web.cart.includes.table', ['carts' => $carts])
                    </tbody>
                </table>
                <a href="{{ route('user.order') }}" class="btn btn-success float-right">Đặt hàng</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function inputChangeQuantity (rowId) {
            let quantity = $('.input-quantity').val();
            process(rowId, quantity);
        }

        function changeQuantityProductPlus (rowId) {
            let quantity = $('.input-quantity').val();
            let newQuantity = parseInt(quantity) + 1;
            process(rowId, newQuantity);
        }

        function changeQuantityProductMinus (rowId) {
            let quantity = $('.input-quantity').val();
            let newQuantity = parseInt(quantity) - 1;
            process(rowId, newQuantity);
        }

        function process (rowId, newQuantity) {
            $.ajax({
                url: '/update-cart/' + rowId,
                method: 'post',
                data: {
                    'quantity': newQuantity
                },
                success: function (response) {
                    if (response.code === 200) {
                        $('tbody').html(response.html);
                        Toast.fire({
                            icon: 'success',
                            title: "Cập nhật giỏ hàng thành công!"
                        })
                    }
                    else if (response.code === 400) {
                        Toast.fire({
                            icon: 'error',
                            title: `Cửa hàng chỉ còn lại ${response.quantity_product} sản phẩm!`
                        })
                    }

                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
    </script>
@endsection