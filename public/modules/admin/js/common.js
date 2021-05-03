$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxStart(function() {
    $('body').addClass('busy');
});

$(document).ajaxStop(function() {
    $('body').removeClass('busy');
});

$(document).ajaxComplete(function() {
    $('body').removeClass('busy');
});

// toastr for vue
// const Toast = Swal.mixin({
//     toast: true,
//     position: 'bottom-end',
//     showConfirmButton: false,
//     timer: 5000,
//     timerProgressBar: true,
//     onOpen: (toast) => {
//         toast.addEventListener('mouseenter', Swal.stopTimer)
//         toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
// });

function getProp(obj, path) {
    var parts = path.split(".");
    while (parts.length) {
        obj = obj[parts.shift()];
    }

    return obj;
}

var stringToSlug = function (str) {
    // Chuyển hết sang chữ thường
    str = str.toLowerCase();

    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');

    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');

    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');

    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');

    // return
    return str;
}

$('.count_char').each(function () {
    var charCount = $(this).val().length;
    $(this).closest('.form-group').find('.count_total').text(charCount);
});

$('.count_char').on('keyup change', function () {
    var charCount = $(this).val().length;
    $(this).closest('.form-group').find('.count_total').text(charCount);
});

// preview image
$("#avatar").change(function() {
    $("#preview-avatar").attr("src", URL.createObjectURL(event.target.files[0]));
    $('.previewAvatar').removeClass('d-none');
});

$('.btn-remove-preview-avatar').on('click', function () {
    $('#preview-avatar').attr('src', '');
    $(this).parent().addClass('d-none');
});

function openModal(modal_id, option) {
    $('#'+modal_id).modal('show');
    $('#'+modal_id).find('.modal-header h4.modal-title span').text(option.title);
}

$('.btn-back-to-top').fadeOut();
$('.content-page').scroll(function(){
    if ($(this).scrollTop() > 500) {
        $('.btn-back-to-top').fadeIn();
    } else {
        $('.btn-back-to-top').fadeOut();
    }
});

$(".btn-back-to-top").click(function () {
    $('.content-page').animate({scrollTop: 0}, 400);
});