<div class="row">
    <div class="col-md-9">
        @include('admin::includes.form-title')
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