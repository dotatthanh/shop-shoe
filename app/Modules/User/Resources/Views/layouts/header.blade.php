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
							<a href="#" title="">Danh mục</a>
						</li>
						<li>
							<a href="#" title="">Giầy bán chạy</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="search">
					<a href="{{ route('user.order') }}">({{ $total_product }}) Sản phẩm</a>
					{{-- <form action="#">
						<input type="text">
						<button href="#" title="">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
					</form> --}}
				</div>
			</div>
		</div>
	</div>

	<!-- Popup register and login -->
    @include('user::user.includes.modal-register-login')
</header>