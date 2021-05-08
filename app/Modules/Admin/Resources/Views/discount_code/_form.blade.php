@csrf
<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label>Mã giảm giá</label>
                    <div class="input-group">
                        <span class="input-group-addon btn-random-discount-code">Tạo tự động</span>
                        <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $dataEdit->code ?? null) }}">
                    </div>
                    {!! $errors->first('code', '<span class="help-block error">:message</span>') !!}
                </div>
        
                <div class="form-group">
                    <label>% giảm giá</label>
                    <input type="number" min="0" max="100" name="percent" class="form-control" value="{{ old('percent', $dataEdit->percent ?? null) }}">
                </div>

                <div class="form-group">
                    <label>Thời gian bắt đầu</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $dataEdit->start_date ?? null) }}">
                </div>
        
                <div class="form-group">
                    <label>Thời gian kết thúc</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $dataEdit->end_date ?? null) }}">
                </div>
        
                <div class="form-group">
                    <label>Loại</label>
                    <input type="text" name="type" class="form-control" value="{{ old('type', $dataEdit->type ?? null) }}">
                    {!! $errors->first('type', '<span class="help-block error">:message</span>') !!}
                </div>
        
                @include('admin::includes.form-status')
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-action', [
                    'routeIndex' => route('admin.discount_code.index')
                ])
            </div>
        </div>
    </div>
</div>