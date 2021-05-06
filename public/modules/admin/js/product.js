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

let index = 0;

function addSize() {
    index++
    let text = `
        <div>
            <div class="col-md-5 mt-1">
                <input 
                    type="text" 
                    name="sizes[${index}]" 
                    class="form-control form-control-custom count_char" 
                    value=""
                    required
                    placeholder="Tên size"
                >
            </div>
            <div class="col-md-5 mt-1">
                <input 
                    type="number" 
                    min="1"
                    name="quantities[${index}]" 
                    class="form-control form-control-custom count_char" 
                    value=""
                    required
                    placeholder="Số lượng"
                >
            </div>
            <div class="col-md-2 mt-1">
                <button type="button" class="btn btn-danger remove-size" onclick="removeSize($(this))">X</button>
            </div>
        </div>
        `;
    $('#add-size .render-list').append(text);
}

function removeSize(obj) {
    obj.parent().parent().remove();
}

$(".select2").select2({});

$(".form-product").validate({
    rules: {
        title: "required",
        slug: "required",
        "sizes[]": "required",
        "quantities[]": "required",
    },
    messages: {
        // title: {required: "Trường này là bắt buộc"},
        // slug: {required: "Trường này là bắt buộc"},
        "sizes[]": {required: "Trường này là bắt buộc"},
        "quantities[]": {required: "Trường này là bắt buộc"},
    }
});