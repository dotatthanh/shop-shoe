<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                @include('admin::includes.form-title')

                <!-- render image common -->
                <div class="card-box box-render-image-common">
                    <div class="form-group product-avatar">
                        <label class="mb-0">{{ __('Product Images') }} </label>
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
                            <a href="javascript:void(0)" onclick="initMediaDiv('uploadListImg')"><b>{{ __('Select Image') }}</b></a>
                        </div>
                    </div>
                </div>

                <div class="card-box">
                    @include('admin::includes.form-content', ['contentTitle' => __('Description')])

                    <div class="form-group">
                        <label>{{ (isset($specificationTitle)) ? $specificationTitle :__('Technical specifications') }}</label>
                        {!! $errors->first('specification', '<span class="help-block error">:message</span>') !!}

                        <div class="m-b-5">
                            <button type="button" class="btn btn-light btn-add-images" onclick="initMediaEditor(specificationEditor)">
                                <i class="fa fa-music" aria-hidden="true"></i> {{ __('Media') }}
                            </button>
                        </div>
                        <textarea name="specification" class="form-control" id="specification" rows="5">{{ old('specification',  $dataEdit->specification ?? null) }}</textarea>
                    </div>
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

    <script>
        var specificationEditor;
        tinymce.init({
            selector:'#specification',
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