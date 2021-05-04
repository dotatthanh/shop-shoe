<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label for="sku">
                        Mã sản phẩm
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="sku" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('sku', $dataEdit->sku ?? '') }}"
                        required
                    >
                    {!! $errors->first('sku', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="title">
                        {{ isset($title_name) ? $title_name : __('Tên sản phẩm') }}
                        <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small>
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('title', $dataEdit->title ?? '') }}"
                        required
                    >
                    {!! $errors->first('title', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="slug">
                        {{ __('Slug') }}
                        <small>({{ __('Tổng số ký tự') }} : <span class="count_total"></span>)</small>
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="slug" 
                        class="form-control form-control-custom count_char" 
                        value="{{ old('slug', $dataEdit->slug ?? '') }}"
                        required
                        readonly
                    >
                    {!! $errors->first('slug', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="supplier_id">
                        Nhà cung cấp
                        <span class="required">*</span>
                    </label>
                    <select class="form-control" name="supplier_id" required>
                            <option></option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('supplier_id', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="category_id">
                        Danh mục
                        <span class="required">*</span>
                    </label>
                    <select class="form-control select2" name="categories[]" required multiple>
                            <option></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('category_id', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="brand_id">
                        Thương hiệu
                        <span class="required">*</span>
                    </label>
                    <select class="form-control" name="brand_id" required>
                            <option></option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('brand_id', '<span class="help-block error">:message</span>') !!}
                </div>

                <!-- render image common -->
                <div class="card-box box-render-image-common">
                    <div class="form-group product-avatar">
                        <label class="mb-0">{{ __('Ảnh sản phẩm *') }} </label>
                        {!! $errors->first('images', '<span class="help-block error">:message</span>') !!}
                        <div class="form-group" id="uploadListImg1">
                            @php
                            if(!empty(old('avatar', $dataEdit->avatar ?? null))) {
                                $faviconCheck = true;
                            } else {
                                $faviconCheck = false;
                            }
                            @endphp

                            @include('commons.avatar', [
                                'avatarCheck' => $faviconCheck,
                                'avatarKey' => 'avatar',
                                'avatarValue' => old('avatar', $dataEdit->avatar ?? null),
                                ])
                        </div>
                    </div>
                </div>

                <div class="card-box box-render-image-common">
                    <div class="form-group product-avatar">
                        <label class="mb-0">{{ __('Ảnh chi tiết sản phẩm *') }} </label>
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
                                        <i class="far fa-times-circle"></i><span></span>
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
                    {{-- @include('admin::includes.form-content', ['contentTitle' => __('Description')]) --}}

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

                <div class="form-group">
                    <label for="sku">
                        Size
                        <span class="required">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-5 text-center">
                            <label>Tên size: </label>
                        </div>
                        <div class="col-md-5 text-center">
                            <label>Số lượng: </label>
                        </div>
                        <div class="col-md-5">
                            <input 
                                type="text" 
                                name="name[]" 
                                class="form-control form-control-custom count_char" 
                                value="{{ old('name', $dataEdit->name ?? '') }}"
                                required
                                >
                        </div>
                        <div class="col-md-5">
                            <input 
                                type="number" 
                                min="1"
                                name="quantity[]" 
                                class="form-control form-control-custom count_char" 
                                value="{{ old('quantity', $dataEdit->quantity ?? '') }}"
                                required
                            >
                        </div>
                    </div>
                    <div class="row" id="add-size">
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
    </div>
</div>

@include('commons.media')

@section('script')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/content-editor.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $('input[name=title]').keyup(function() {
            $('input[name=slug]').val(stringToSlug(this.value));
            $('input[name=slug]').trigger('keyup');
        });

        $(".select2").select2({ 
        });

        // $('.remove-size').click(function(event) {
        // });

        function removeSize(obj) {
            obj.parent().parent().remove();
        }

        function addSize() {
            let text = `
                <div>
                    <div class="col-md-5 mt-1">
                        <input 
                            type="text" 
                            name="name[]" 
                            class="form-control form-control-custom count_char" 
                            value="{{ old('name', $dataEdit->name ?? '') }}"
                            required
                        >
                    </div>
                    <div class="col-md-5 mt-1">
                        <input 
                            type="number" 
                            min="1"
                            name="quantity[]" 
                            class="form-control form-control-custom count_char" 
                            value="{{ old('quantity', $dataEdit->quantity ?? '') }}"
                            required
                        >
                    </div>
                    <div class="col-md-2 mt-1">
                        <button type="button" class="btn btn-danger remove-size" onclick="removeSize($(this))">X</button>
                    </div>
                </div>
                `;
            $('#add-size').prepend(text);
        }
    </script>
    <script>
        var specificationEditor;
        tinymce.init({
            selector:'#description',
            height: 400,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc',
                'paste'
            ],
            toolbar: 'cut copy wordcount' +
            '| undo redo' +
            '| bold italic underline strikethrough' +
            '| forecolor backcolor' +
            '| fontsizeselect formatselect' +
            '| bullist numlist ' +
            '| blockquote hr pagebreak' +
            '| alignleft aligncenter alignright alignjustify' +
            '| outdent indent' +
            '| a11ycheck ltr rtl' +
            '| link unlink image media' +
            '| table removeformat charmap' +
            '| code fullscreen preview print ',
            menubar: true,
            setup: function (editor) {
                specificationEditor = editor;
            },
            fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 36px 38px 40px",
            paste_auto_cleanup_on_paste : true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: true,
            convert_urls : false,
            branding: false,
        });
    </script>
@endsection