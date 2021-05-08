@extends('user::layouts.master')

@section('content')
	<!-- 			Content			 -->
	<div class="container order">
		<form action="{{ route('checkout') }}" method="post">
			@csrf
			<div class="row">
				<div class="col-lg-7">
					<h1 class="font-weight-bold title-order">ĐỊA CHỈ NHẬN HÀNG</h1>
					<hr>
					@if (auth()->user())
						<div class="info-bill">
						    <p class="font-weight-bold">Họ và tên</p>
						    <input disabled type="text" class="m-top10" id="" name="" value="{{ auth()->user()->name }}">
						
						    <p class="font-weight-bold">Số điện thoại</p>
						    <input disabled type="text" class="m-top10" id="" name="" value="{{ auth()->user()->phone }}">
						
						    <p class="font-weight-bold">Địa chỉ</p>
						    <input disabled type="text" class="m-top10" id="" name="" value="{{ auth()->user()->address }}">
						</div>
					@else
						<p>Bạn chưa đăng nhập để có thể đặt hàng, 
							<a href="javascript:void(0)" onclick="showModalUser('login')" style="color:blue">đăng nhập</a>
							ngay</p>
					@endif

					{{-- <h2 class="title-order font-weight-bold m-top-25">VẬN CHUYỂN QUA</h2>
					<div class="transport">
						<label><input type="radio" checked="checkked"><span class="pad-l-10">CHUYỂN PHÁT NHANH <span>0 ₫</span></span></label>
					</div> --}}
				</div>

				<div class="col-lg-5 review-order">
					<h2 class="title-order font-weight-bold">ĐƠN HÀNG CỦA BẠN</h2>
					<hr>
					<table class="w-100">
						<tr class="bg th">
							<td>Tên sản phẩm</td>
							<td class="text-center price-order">Giá</td>
							<td class="text-center amount-order">Số lượng</td>
							<td class="text-center total-money-order">Tổng số tiền</td>
						</tr>

						@foreach ($cart as $product)
							<tr>
								<td class="info-product-order">
									<h3><a href="">{{ $product->name }}</a></h3>
									<p class="font-weight-bold font-italic size-order">
										<span>Size: </span>
										<span class="font-weight-normal pad-l-10">
											{{ $product->options['size']['name'] }}
										</span>
									</p>
								</td>
								<td class="text-center">{{ $product->price }} ₫</td>
								<td class="text-center">{{ $product->qty }}</td>
								<td class="text-center">{{ $product->price }} ₫</td>
							</tr>
						@endforeach

						{{-- <tr class="bg">
							<td colspan="3" class="text-right">Tổng số</td>
							<td>{{ $total_money }} ₫</td>
						</tr> --}}
						{{-- <tr class="bg">
							<td colspan="3" class="text-right">Vận chuyển qua (CHUYỂN PHÁT NHANH)</td>
							<td>0 ₫</td>
						</tr> --}}
						<tr class="bg">
							<td colspan="3" class="text-right font-weight-bold">Tổng cộng</td>
							<td class="font-weight-bold text-center">{{ $total_money }} ₫</td>
						</tr>
					</table>

					<p class="node-order">Ghi chú</p>
					<textarea name="note" id="" rows="7" class="w-100 form-control"></textarea>

					@if (isset($codeSale) && $codeSale->count() > 0)
						<p class="node-order">
							<span>Mã giảm giá: </span>
							<span class="required">{{ $codeSale->code }} - Giảm {{ $codeSale->percent }}%</span>	
						</p> <br/>
						<div class="input-group">
							<input type="text" class="form-control" name="code_sale" placeholder="Nhập mã giảm giá">
						</div>
					@endif
					@if (auth()->user())
						<button type="submit" class="font-weight-bold mt-3">GỬI ĐẶT HÀNG</button>
					@else
						<button type="button" onclick="showModalUser('login')" class="font-weight-bold mt-3">GỬI ĐẶT HÀNG</button>
					@endif
				</div>
			</div>
		</form>	
	</div>
	<!-- 			End Content			 -->
@endsection