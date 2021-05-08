<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="brand">
					@if (auth()->user())
						<a href="javascript:void(0)">
							Xin chào <b style="font-size: 16px">{{ auth()->user()->name }}</b>
						</a>
					@else
						<a href="javascript:void(0)" onclick="showModalUser('login')">
							Đăng nhập
						</a>
						<a href="javascript:void(0)" onclick="showModalUser('register')">
							Đăng ký
						</a>
					@endif
					
					<a href="#" title="">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
					<a href="#" title="">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
					<a href="#" title="">
						<i class="fa fa-instagram" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 logo">
				<a href="#" title="">
					<img title="" class="img-responsive" src="{{ asset('images/logo.jpg')}}" alt="">
				</a>
				<h1>
					<a href="#" title="">S-FASHION</a>
				</h1>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="menu">
					<button class="menu-btn" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
					<ul>
						<li>
							<a href="{{ route('home') }}" title="">Trang chủ</a>
						</li>
						<li>
							<a href="javascript:void(0)" title="">Danh mục</a>
							<i class="down fa fa-angle-down" aria-hidden="true"></i>
							<ul>
								@foreach ($categories as $category)
								<li>
									<a href="{{ route('user.category', $category->slug) }}" title="">{{ $category->title }}</a>
								</li>
								@endforeach
							</ul>
						</li>
						<li>
							<a href="{{ route('user.category', 'san-pham-ban-chay') }}" title="">Hàng bán chạy</a>
						</li>
						<li>
							<a href="{{ route('user.category', 'san-pham-moi') }}" title="">Hàng mới</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="search">
					<a href="{{ route('user.show-cart') }}">(<span class="totalProduct">{{ $total_product }}</span>) Sản phẩm</a>
				</div>
			</div>
		</div>
	</div>

    @include('user::user.includes.modal-register-login')
</header>