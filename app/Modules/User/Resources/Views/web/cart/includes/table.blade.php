@foreach ($carts as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>
            <a href="{{ route('user.product-detail', ['slug' => $item->options['product_slug'], 'id' => $item->options['product_id']]) }}" target="_blank" style="display: block; color: blue; font-size: 16px">{{ $item->name }}</a>
            <span style="font-size: 13px">(Kích cỡ: {{ $item->options['size']['name'] }})</span>
        </td>
        <td class="text-center" style="display: flex; justify-content: center">
            <button type="button" class="btn-increment" onclick="changeQuantityProductMinus(event, '{{ $item->rowId }}')">-</button>
            <input 
                type="number" 
                min="0" 
                class="form-control input-quantity"
                value="{{ $item->qty }}"
                onkeyup="inputChangeQuantity(event, '{{ $item->rowId }}')"
            >
            <button type="button" class="btn-increment" onclick="changeQuantityProductPlus(event, '{{ $item->rowId }}')">+</button>
        </td>
        <td>{{ number_format($item->price) }} VNĐ</td>
        <td>{{ number_format($item->qty * $item->price) }} VNĐ</td>
        <td style="text-align: right">
            <form class="d-inline-block" method="POST" action="{{ route('remove-product-in-cart', $item->rowId) }}">
                @csrf
                <button class="w-60px btn btn-danger" type="submit">Xóa</button>
            </form>        
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6" style="text-align: right">
        <b>Tổng tiền: {{ number_format($total) }} VNĐ</b>
    </td>
</tr>