var contentEditor;
tinymce.init({ 
    selector:'#content',
    content_css: [
        "/css/style-editor.css?v=1.0.1",
    ],
    height: 500,
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern codesample toc',
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
    '| ltr rtl' +
    '| link unlink image media' +
    '| table removeformat charmap' +
    '| code fullscreen preview print ',
    menubar: false,
    setup: function (editor) {
        contentEditor = editor;
    },
    fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 36px 38px 40px",
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true,
    paste_remove_styles_if_webkit: true,
    paste_strip_class_attributes: true,
    convert_urls : false,
    branding: false,
});
