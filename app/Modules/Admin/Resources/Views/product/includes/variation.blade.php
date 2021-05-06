<div class="row" style="margin-bottom: 5px">
    <div class="col-md-5">
        <input 
            type="text" 
            name="sizes[{{ $index }}]" 
            class="form-control form-control-custom count_char" 
            value="{{ $item['name'] ?? null }}"
            required
            placeholder="Tên size"
        >
    </div>
    <div class="col-md-5">
        <input 
            type="number" 
            min="1"
            name="quantities[{{ $index }}]" 
            class="form-control form-control-custom count_char" 
            value="{{ $item['quantity'] ?? null }}"
            required
            placeholder="Số lượng"
        >
    </div>
    @if ($index > 0)
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-size" onclick="removeSize($(this))">X</button>
        </div>
    @endif
</div>