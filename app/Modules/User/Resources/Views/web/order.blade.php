@extends('user::layouts.master')

@section('content')
	<!-- 			Content			 -->
	<div class="container order">
		<form action="#" method="">
			<div class="row">
				<div class="col-lg-7">
					<h1 class="font-weight-bold title-order">THÔNG TIN HÓA ĐƠN</h1>
					<div class="info-bill">
					    <p>Họ và tên <span>*</span></p>
					    <input type="text" class="" id="" name="">
					
					    <p>Số điện thoại <span>*</span></p>
					    <input type="text" class="" id="" name="">
					
					    <p>Tỉnh/Thành <span>*</span></p>
					    <select name="" id="" class="">
					    	<option value="">1</option>
					    	<option value="">1</option>
					    	<option value="">1</option>
					    </select>
					
					    <p>Địa chỉ <span>*</span></p>
					    <input type="text" class="" id="" name="">
					</div>

					<h2 class="title-order font-weight-bold m-top-25">VẬN CHUYỂN QUA</h2>
					<div class="transport">
						<label><input type="radio" checked="checkked"><span class="pad-l-10">CHUYỂN PHÁT NHANH <span>0 ₫</span></span></label>
					</div>
				</div>

				<div class="col-lg-5 review-order">
					<h2 class="title-order font-weight-bold">XEM LẠI ĐƠN HÀNG</h2>
					<table class="w-100">
						<tr class="bg th">
							<td>Tên sản phẩm</td>
							<td class="text-center price-order">Giá</td>
							<td class="text-center amount-order">Số lượng</td>
							<td class="text-center total-money-order">Tổng số tiền</td>
						</tr>
						<tr>
							<td class="info-product-order">
								<h3><a href="">LD826 ĐẦM XÒE HỌA TIẾT HOA NỔI (ĐEN)</a></h3>
								<p class="font-weight-bold font-italic color-order">Màu sắc: <span class="font-weight-normal pad-l-10">Đen</span></p>
								<p class="font-weight-bold font-italic size-order">Size: <span class="font-weight-normal pad-l-10">S</span></p>
							</td>
							<td class="text-center">292.500 ₫</td>
							<td class="text-center">1</td>
							<td class="text-center">292.500 ₫</td>
						</tr>
						<tr>
							<td class="info-product-order">
								<h3><a href="">LD826 ĐẦM XÒE HỌA TIẾT HOA NỔI (ĐEN)</a></h3>
								<p class="font-weight-bold font-italic color-order">Màu sắc: <span class="font-weight-normal pad-l-10">Đen</span></p>
								<p class="font-weight-bold font-italic size-order">Size: <span class="font-weight-normal pad-l-10">S</span></p>
							</td>
							<td class="text-center">292.500 ₫</td>
							<td class="text-center">1</td>
							<td class="text-center">292.500 ₫</td>
						</tr>
						<tr>
							<td class="info-product-order">
								<h3><a href="">LD826 ĐẦM XÒE HỌA TIẾT HOA NỔI (ĐEN)</a></h3>
								<p class="font-weight-bold font-italic color-order">Màu sắc: <span class="font-weight-normal pad-l-10">Đen</span></p>
								<p class="font-weight-bold font-italic size-order">Size: <span class="font-weight-normal pad-l-10">S</span></p>
							</td>
							<td class="text-center">292.500 ₫</td>
							<td class="text-center">1</td>
							<td class="text-center">292.500 ₫</td>
						</tr>
						<tr class="bg">
							<td colspan="3" class="text-right">Tổng số</td>
							<td>292.500 ₫</td>
						</tr>
						<tr class="bg">
							<td colspan="3" class="text-right">Vận chuyển qua (CHUYỂN PHÁT NHANH)</td>
							<td>0 ₫</td>
						</tr>
						<tr class="bg">
							<td colspan="3" class="text-right font-weight-bold">Tổng cộng</td>
							<td class="font-weight-bold">292.500 ₫</td>
						</tr>
					</table>

					<p class="node-order">Ghi chú</p>
					<textarea name="" id="" rows="7" class="w-100"></textarea>
					<button type="submit" class="font-weight-bold">GỬI ĐẶT HÀNG</button>
				</div>
			</div>
		</form>	
	</div>
	<!-- 			End Content			 -->
@endsection