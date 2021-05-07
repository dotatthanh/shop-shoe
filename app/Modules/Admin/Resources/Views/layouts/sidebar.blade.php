<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('/images/default.jpg') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ auth()->guard('admin')->user()->name }}</p>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="{{ request()->segment(2) === 'dashboard' ? 'active' : '' }}">
				<a href="{{ route('admin.dashboard') }}">
					<i class="fa fa-dashboard"></i> <span>Trang chủ</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'product' ? 'active' : '' }}">
				<a href="{{ route('admin.product.index') }}">
					<i class="fa fa-product-hunt"></i> 
					<span>Sản phẩm</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'order' ? 'active' : '' }}">
				<a href="{{ route('admin.order.index') }}">
					<i class="fa fa-cart-plus"></i> 
					<span>Đơn hàng</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'categories' ? 'active' : '' }}">
				<a href="{{ route('admin.categories.index') }}">
					<i class="fa fa-folder"></i> 
					<span>Danh mục</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'suppliers' ? 'active' : '' }}">
				<a href="{{ route('admin.suppliers.index') }}">
					<i class="fa fa-circle-o"></i> 
					<span>Nhà cung cấp</span>
				</a>
			</li>
			{{-- <li>
				<a href="{{ route('admin.types.index') }}">
					<i class="fa fa-circle-o text-red"></i> 
					<span>Type</span>
				</a>
			</li> --}}
			<li class="{{ request()->segment(2) === 'brands' ? 'active' : '' }}">
				<a href="{{ route('admin.brands.index') }}">
					<i class="fa fa-btc"></i> 
					<span>Thương hiệu</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'discount_code' ? 'active' : '' }}">
				<a href="{{ route('admin.discount_code.index') }}">
					<i class="fa fa-codiepie"></i> 
					<span>Mã giảm giá</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'member' ? 'active' : '' }}">
				<a href="{{ route('admin.member.index') }}">
					<i class="fa fa-user"></i>
					<span>Thành viên</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'role' ? 'active' : '' }}">
				<a href="{{ route('admin.role.index') }}">
					<i class="fa fa-key"></i>
					<span>Vai trò</span>
				</a>
			</li>
			<li class="{{ request()->segment(2) === 'permission' ? 'active' : '' }}">
				<a href="{{ route('admin.permission.index') }}">
					<i class="fa fa-user-secret"></i>
					<span>Quyền hạn</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>