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

//Get all role
$("select.select2Role").select2({
    ajax: {
        url: '/admin/role/getAll',
        data: function (term) {
            return {
                search: term
            };
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
    }
});

onChangeRoleMember();
function onChangeRoleMember () {
    $('.select2Role').on('select2:select', function(e) {
        callCheckPermission(e);
    });

    $('.select2Role').on('select2:unselect', function(e) {
        callCheckPermission(e);
    });
}

function callCheckPermission(e) {
    let listPer = $('input:checkbox.listPermission');
    for (let i = 0; i < listPer.length; i++) {
        let item = listPer[i]['disabled'];
        if (item) {
            $('#'+listPer[i].id).prop('checked', false);
            $('#'+listPer[i].id).prop('disabled', false);
        }
        
    }

    let idRole = $(e.target).val();
    $.ajax({
        url: '/admin/role/getPermissionOfRole',
        type: 'post',
        data: {
            roleId : idRole
        },
        delay: 1000,
        success: function (data) {
            data.forEach(function(element) {
                $('#permission'+element).prop('checked', true);
                $('#permission'+element).prop('disabled', true);
            });
        },
        error: function (err) {
            console.log(err);
        }
    });
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function getProp(obj, path) {
    var parts = path.split(".");
    while (parts.length) {
        obj = obj[parts.shift()];
    }

    return obj;
}

var stringToSlug = function (str) {
    str = str.toLowerCase();
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
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

$('.btn-random-discount-code').on('click', function () {
    $.ajax({
        url: '/admin/discount_code/random',
        method: 'GET',
        success: function (response) {
            if (response.code === 200) {
                $('#code').val(response.data);
            }
        },
        error: function (error) {
            console.log(error)
        }
    })
});

$('.title-input').on('blur', function () {
    let str = $(this).val()
    str = str.replace(/([^0-9a-zA-Z-\s])/g, '');
    $(this).val(str)
});

$('.sku-input').on('blur', function () {
    let str = $(this).val()
    str = str.replace(/([^0-9a-zA-Z-\s])/g, '');
    $(this).val(str)
});