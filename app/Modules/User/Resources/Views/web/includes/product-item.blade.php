<div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
    <a href="{{ route('user.product-detail', ['slug' => $item->slug, 'id' => $item->id]) }}" title="" class="c-img">
        <img title="{{ $item->title }}" src="{{ asset($item->image)}}" alt="{{ $item->title }}">
    </a>
    <div class="info-product">
        <h3 class="title-product">
            <a href="{{ route('user.product-detail', ['slug' => $item->slug, 'id' => $item->id]) }}"  title="{{ $item->title }}">{{ $item->title }}</a>
        </h3>
        <span class="price">{{ number_format($item->price) }} VNĐ</span>
        <form action="#">
            <a href="{{ route('user.product-detail', ['slug' => $item->slug, 'id' => $item->id]) }}" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <a href="{{ route('user.product-detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="add href">XEM CHI TIẾT</a>
        </form>
    </div>
</div>