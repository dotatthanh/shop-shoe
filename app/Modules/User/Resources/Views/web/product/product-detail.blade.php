@extends('user::layouts.master')

@section('content')
	<!-- 			Content			 -->
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="list-item">
					<ul>
						<li><a href="{{ route('home') }}" title=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li><a href="{{ route('user.category', $product->product_categories->first()->category->slug) }}" title="">{{ $product->product_categories->first()->category->title }}</a></li>
						<li><a href="{{ route('user.product-detail', ['slug' => $product->slug, 'id' => $product->id ]) }}" title="">{{ $product->title }}</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="slider-nav">
							@foreach ($product->product_images->take(3)->all() as $image_detail)
								<img src="{!! $image_detail->url !!}" alt="">
							@endforeach
						</div>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9">
						<div class="slider-for">
							@foreach ($product->product_images as $image_detail)
								<img src="{!! $image_detail->url !!}" alt="">
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-12 product-detail p-bot20">
				<form action="{{ route('add-to-cart', $product->id) }}" method="POST">
					@csrf
					<h2>{{ $product->title }}</h2>
					<div class="stt">
						<p>Tình trạng:</p> <span id="status">{{ $product->sizes->first()->quantity > 0 ? 'Còn hàng' : 'Hết hàng'}}</span>
					</div>
					<div class="product-code">
						<p>Mã SP:</p> <span>{{ $product->sku }}</span>
					</div>

					{{-- Check sale price --}}
					@if ($product->sale_price)
						<div class="price-product">
							<p>Giá bán:</p> <span><del>{{ number_format($product->price) }} VND</del></span>
						</div>
						<div class="price-product">
							<p>Giá khuyến mãi:</p> <span>{{ number_format($product->sale_price) }} VND</span>
						</div>
					@else
						<div class="price-product">
							<p>Giá bán:</p> <span>{{ $product->price }}</span>
						</div>
					@endif
					{{-- End check --}}

					<div class="size">
						<p>Size:</p> 
						<select name="size" onchange="getQuantityProduct($(this).val())">
							@foreach ($product->sizes as $size)
								<option value="{{ $size }}">{{ $size->name }}</option>
							@endforeach
						</select>
					</div>    
					<div class="amount">
						<p>Số lượng còn:</p> <span id="quantity">{{ $product->sizes->first()->quantity }}</span>
					</div>

					<div class="m-top20">
						<a href="#other-products" title="" class="product-other">Sản phẩm khác</a>
						<button type="submit" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 product-info">
				<div class="border-bottom">
					<h3>Thông tin sản phẩm</h3>
					<div class="bg-color">
						{!! $product->description !!}
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- 			Phụ kiện			-->
	<div class="container p-top50 p-bot30">
		<h2 class="title-category">
			<a href="javascript:void(0)" id="other-products" title="">SẢN PHẨM KHÁC</a>
		</h2>
		<div class="row p-top30">
			@foreach ($products as $item)
				@include('user::web.includes.product-item', ['item' => $item])
			@endforeach
		</div>
	</div>
	<!-- 			End Phụ kiện -->

	<!-- 			End Content			 -->
@endsection
@section('js')
    <script type="text/javascript">
    	function getQuantityProduct(obj) {
    		let size = JSON.parse(obj);

    		// Lấy số lượng hàng
    		$(`#quantity`).text(size.quantity);

    		// Set trạng thái
    		if (size.quantity > 0) {
    			$(`#status`).text('Còn hàng');
    		}
    		else {
    			$(`#status`).text('Hết hàng');
    		}
    	}
    </script>
@endsection