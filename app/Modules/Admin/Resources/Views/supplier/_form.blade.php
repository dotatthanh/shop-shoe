<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-title')
                <div class="form-group">
                    <label for="email">
                        Email
                        <small>({{ __('Total number of characters') }}: <span class="count_total"></span>)</small>
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('email', $dataEdit->email ?? '') }}"
                        required
                    >
                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label for="phone">
                        Số điện thoại
                        <small>({{ __('Total number of characters') }}: <span class="count_total"></span>)</small>
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="phone" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('phone', $dataEdit->phone ?? '') }}"
                        min="0"
                        required
                    >
                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label for="address">
                        Địa chỉ
                        <small>({{ __('Total number of characters') }}: <span class="count_total"></span>)</small>
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="address" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('address', $dataEdit->address ?? '') }}"
                        required
                    >
                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-action', [
                    'routeIndex' => route('admin.categories.index')
                ])
            </div>
        </div>
    </div>
</div>