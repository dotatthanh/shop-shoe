<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-title')
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-action', [
                    'routeIndex' => route('admin.brands.index')
                ])
            </div>
        </div>
    </div>
</div>