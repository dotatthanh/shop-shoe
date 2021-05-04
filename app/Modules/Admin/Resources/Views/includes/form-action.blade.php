<div class="widget">
    <div class="widget__title">
        <label class="mb-1">Thao tác</label>
    </div>
    
    <div class="widget__body text-center">
        <button type="submit" class="btn btn-success mr-2 mb-2">
            <i class="fa fa-save"></i>
            {{ __('Lưu') }}
        </button>
        <a href="{{ $routeIndex }}" class="btn btn-default mb-2">
            <i class="fa fa-undo"></i>
            {{ __('Trở lại') }}
        </a>
    </div>
</div>