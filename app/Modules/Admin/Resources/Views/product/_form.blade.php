@csrf
<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="sku">Mã sản phẩm <span class="required">*</span></label>
                    <input 
                        type="text" 
                        name="sku" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('sku', $dataEdit->sku ?? '') }}"
                        required
                    >
                    {!! $errors->first('sku', '<span class="help-block error">:message</span>') !!}
                </div>

                @include('admin::includes.form-title')

                <div class="card-box box-render-image-common">
                    <div class="form-group product-avatar">
                        <label class="mb-0">{{ __('Ảnh chi tiết sản phẩm') }} <span class="required">*</span></label>
                        {!! $errors->first('images', '<span class="help-block error">:message</span>') !!}
                        <div class="upload-list-img" id="uploadListImg">
                            @php
                                $images = old('images',  $product_images ?? []);
                            @endphp
                            @foreach ($images as $item)
                                <div class="item">
                                    <img class="img-thumbnail" src="{{ $item }}">
                                    <input type="hidden" name="images[]" value="{{ $item }}">
                                    <span onclick="removeImgUpload(this)" class="remove-img">
                                        <i class="fa fa-times-circle"></i><span></span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="initMediaDiv('uploadListImg')"><b>{{ __('Chọn ảnh') }}</b></a>
                        </div>
                    </div>
                </div>


                <div class="card-box">
                    <div class="form-group">
                        <label>{{ (isset($specificationTitle)) ? $specificationTitle :__('Mô tả') }}</label>
                        {!! $errors->first('description', '<span class="help-block error">:message</span>') !!}

                        <div class="m-b-5">
                            <button type="button" class="btn btn-light btn-add-images" onclick="initMediaEditor(specificationEditor)">
                                <i class="fa fa-music" aria-hidden="true"></i> {{ __('Media') }}
                            </button>
                        </div>
                        <textarea name="description" class="form-control" id="description" rows="5">{{ old('description',  $dataEdit->description ?? null) }}</textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sku">
                                Giá bán
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="price" 
                                class="form-control form-control-custom count_char" 
                                value="{{ old('price', $dataEdit->price ?? '') }}"
                                required
                            >
                            {!! $errors->first('price', '<span class="help-block error">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sku">
                                Giá khuyến mãi
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="sale_price" 
                                class="form-control form-control-custom count_char" 
                                value="{{ old('sale_price', $dataEdit->sale_price ?? '') }}"
                                required
                            >
                            {!! $errors->first('sale_price', '<span class="help-block error">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sku">
                        Sản phẩm có nhiều loại
                        <span class="required">*</span>
                    </label>
                    @if (isset($product_sizes) && count($product_sizes) > 0)
                        @foreach ($product_sizes as $index => $item)
                            @include('admin::product.includes.variation', [
                                'item' => $item,
                                'index' => $index
                            ])
                        @endforeach
                    @else
                        @include('admin::product.includes.variation', [
                            'item' => null,
                            'index' => 0
                        ])
                    @endif
                    <div class="row" id="add-size">
                        <div class="render-list"></div>
                        <div class="col-md-12 mt-1">
                            <button type="button" class="btn btn-success" onclick="addSize()">+</button>
                        </div>
                    </div>
                    {!! $errors->first('sale_price', '<span class="help-block error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-action', [
                    'routeIndex' => route('admin.product.index')
                ])
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <!-- render image common -->
                <div class="card-box box-render-image-common">
                    <div class="form-group product-avatar">
                        <label class="mb-0">{{ __('Ảnh sản phẩm') }} <span class="required">*</span></label>
                        {!! $errors->first('image', '<span class="help-block error">:message</span>') !!}
                        <div class="form-group" id="uploadListImg1">
                            @php
                            if(!empty(old('image', $dataEdit->image ?? null))) {
                                $faviconCheck = true;
                            } else {
                                $faviconCheck = false;
                            }
                            @endphp

                            @include('commons.avatar', [
                                'avatarCheck' => $faviconCheck,
                                'avatarKey' => 'image',
                                'avatarValue' => old('image', $dataEdit->image ?? null),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="supplier_id">Nhà cung cấp <span class="required">*</span></label>
                    <select class="form-control" name="supplier_id" required>
                        <option></option>
                        @foreach ($suppliers as $supplier)
                            <option 
                                value="{{ $supplier->id }}"
                                @if (isset($dataEdit->supplier_id) && $dataEdit->supplier_id === $supplier->id)
                                    selected
                                @endif
                            >{{ $supplier->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('supplier_id', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục<span class="required">*</span></label>
                    <select class="form-control select2" name="categories[]" required multiple>
                        <option></option>
                        @foreach ($categories as $category)
                            <option 
                                value="{{ $category->id }}"
                                @if (isset($product_categorie_ids) && in_array($category->id, $product_categorie_ids))
                                    selected
                                @endif
                            >{{ $category->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('category_id', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="brand_id">Thương hiệu<span class="required">*</span></label>
                    <select class="form-control" name="brand_id" required>
                        <option></option>
                        @foreach ($brands as $brand)
                            <option 
                                value="{{ $brand->id }}"
                                @if (isset($dataEdit->brand_id) && $dataEdit->brand_id === $brand->id)
                                    selected
                                @endif
                            >{{ $brand->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('brand_id', '<span class="help-block error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('commons.media')

@section('script')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/content-editor.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('modules/admin/js/product.js') }}"></script>
@endsection