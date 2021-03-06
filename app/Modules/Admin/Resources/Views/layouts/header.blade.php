<header class="main-header">
	<!-- Logo -->
	<a href="javascript:void(0)" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>S</b>E</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Shop Shoe</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('/images/default.jpg') }}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ auth()->guard('admin')->user()->name }}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="{{ asset('/images/default.jpg') }}" class="img-circle" alt="User Image">

							<p>
								{{ auth()->guard('admin')->user()->name }}
							</p>
						</li>
						<!-- Menu Body -->
						{{-- <li class="user-body">
							<div class="row">
								<div class="col-xs-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
							</div>
							<!-- /.row -->
						</li> --}}
						<!-- Menu Footer-->
						<li class="user-footer">
							{{-- <div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Thông tin cá nhân</a>
							</div> --}}
							<div class="pull-right">
								<a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>