<div class="widget">
    @php
        $checkStatus = old('status', $dataEdit->status ?? '')
    @endphp

    <div class="widget__title">
        <label for="status">Trạng thái</label>
    </div>

    <div class="widget__body">
        <div class="checkbox__custom">
            <span class="radio-field">
                <label style="font-weight: normal">
                    <input type="radio" id="publish" value="publish" name="status" {{ $checkStatus == 'publish' ? 'checked' : 'checked' }}>
                    <span class="radio-field-text publish">Công khai</span>
                </label>
            </span>
        </div>

        <div class="checkbox__custom">
            <span class="radio-field">
                <label style="font-weight: normal">
                    <input type="radio" id="private" value="private" name="status" {{ $checkStatus == 'private' ? 'checked' : '' }}>
                    <span class="radio-field-text draft">Riêng tư</span>
                </label>
            </span>
        </div>
    </div>
</div>
