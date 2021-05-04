$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showModalUser (param) {
    if (param === 'register') {
        $('.tab-register').addClass('active');
        $('.tab-login').removeClass('active');

        $('.tab-content-register').addClass('active');
        $('.tab-content-login').removeClass('active');
        $('.tab-content-login').removeClass('show');
        $('.tab-content-register').addClass('in');
        $('.tab-content-login').removeClass('in');
    }
    if (param === 'login') {
        $('.tab-login').addClass('active');
        $('.tab-register').removeClass('active');

        $('.tab-content-register').removeClass('active');
        $('.tab-content-register').removeClass('show');
        $('.tab-content-login').addClass('active');
        $('.tab-content-login').addClass('in');
        $('.tab-content-register').removeClass('in');
    }
    $('#modal-register-login').modal('show');
}

$(document).on('click', '.tab-login', function () {
    $('.tab-register').removeClass('active');
})

$(document).on('click', '.tab-register', function () {
    $('.tab-login').removeClass('active');
})