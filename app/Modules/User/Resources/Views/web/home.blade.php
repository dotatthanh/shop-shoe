@extends('user::layouts.master')

@section('content')
	<!-- 			Content			 -->
	<div class="container p-top50 pad20">
		<div class="row row20">
			<div class="col-md-7 col-sm-7 col-xs-12 pad20">
				<div class="slider-noibat">
					<div><a href="#" class="c-img" title=""><img title="" src="{{ asset('images/anh-noi-bat.jpg')}}" alt=""></a></div>
					<div><a href="#" class="c-img" title=""><img title="" src="{{ asset('images/anh-noi-bat.jpg')}}" alt=""></a></div>
					<div><a href="#" class="c-img" title=""><img title="" src="{{ asset('images/anh-noi-bat.jpg')}}" alt=""></a></div>
					<div><a href="#" class="c-img" title=""><img title="" src="{{ asset('images/anh-noi-bat.jpg')}}" alt=""></a></div>
				</div>
				<ul class="category">
					@foreach ($categories as $category)
						<li>
							<a href="{{ route('user.category', $category->slug) }}" title="">{{ $category->title }}</a>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-12 pad20">
				<div class="row row10">
					<div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
						<a href="#" title="" class="c-img">
							<img title="" src="{{ asset('images/anh2-2.jpg')}}" alt="">
						</a>
						<div class="shirt">
							<a href="#" title="">ÁO</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
						<a href="#" title="" class="c-img">
							<img title="" src="{{ asset('images/anh2-2.jpg')}}" alt="">
						</a>
						<div class="trousers">
							<a href="#" title="">QUẦN</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
						<a href="#" title="" class="c-img">
							<img title="" src="{{ asset('images/anh2-2.jpg')}}" alt="">
						</a>
						<div class="shoes">
							<a href="#" title="">GIẦY</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
						<a href="#" title="" class="c-img">
							<img title="" src="{{ asset('images/anh2-2.jpg')}}" alt="">
						</a>
						<div class="accessories">
							<a href="#" title="">PHỤ KIỆN</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 			SP bán chạy -->
	<div class="container p-top50">
		<h2 class="title-category">
			<a href="javascript:void(0)" title="">SẢN PHẨM BÁN CHẠY</a>
		</h2>
		<div class="row p-top30">
			@foreach ($productHots as $item)
				@include('user::web.product.item', ['item' => $item])
			@endforeach
		</div>
	</div>
	<!-- 			End SP bán chạy -->

	<!-- 			SP Mới -->
	<div class="container p-top50 p-bot50">
		<h2 class="title-category bg-product-new">
			<a href="javascript:void(0)" title="">SẢN PHẨM MỚI</a>
		</h2>
		<div class="row p-top30">
			@foreach ($newProducts as $item)
				@include('user::web.product.item', ['item' => $item])
			@endforeach
		</div>
	</div>
	<!-- 			End SP Mới -->
@endsection