@extends('user::layouts.master')

@section('content')
	<div class="select">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form action="">
						<div class="category-product">
							<p>{{ $category['title'] }}</p>
						</div>
						<div class="price-range">
							<p>KHOẢNG GIÁ</p>
							<input type="number" min="0" name="price_min" value="{{ old('price_min',  request()->price_min) }}" placeholder="Giá nhỏ nhất">
							<span>-</span>
							<input type="number" min="0" name="price_max" value="{{ old('price_max',  request()->price_max) }}" placeholder="Giá lớn nhất">
							<button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container p-top20">
		<div class="row">
			@foreach ($products as $item)
				@include('user::web.product.item', ['item' => $item])
			@endforeach
		</div>
	</div>

	<div class="container p-bot50">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				{{-- <div class="te-pagination">
			          <strong>1</strong>
			          <a href="#" title="">2</a>
			          <a href="#" title="">...</a>
			          <a href="#" title="">6</a>
			          <a href="#" title="">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div> --}}
				{{ $products->appends(['search' => $search])->links() }}
			</div>
		</div>
	</div>
	<!-- 			End Content			 -->
@endsection