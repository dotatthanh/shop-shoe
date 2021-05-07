<form class="form-register" action="{{ route('submit-register') }}" method="POST">
    @csrf
    <div class="summery_error" id="register_error" style="display: none"></div>
    <input type="hidden" name="current_path" value="{{ request()->path() }}">
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-user icon"></i>
            <input type="text" class="info" placeholder="{{ __('Họ và tên') }}" value="{{ old('name') }}" name="name" required>
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-envelope icon"></i>
            <input type="email" class="info" placeholder="{{ __('Email') }}" value="{{ old('email') }}" name="email" required>
            {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-user icon"></i>
            <input type="text" class="info" placeholder="{{ __('Số điện thoại') }}" value="{{ old('phone') }}" name="phone" required>
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-user icon"></i>
            <input type="text" class="info" placeholder="{{ __('Địa chỉ') }}" value="{{ old('address') }}" name="address" required>
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-lock icon icon-lock"></i>
            <input type="password" id="password" class="info" placeholder="{{ __('Mật khẩu') }}" name="password" required>
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-lock icon icon-lock"></i>
            <input type="password" class="info" placeholder="{{ __('Xác nhận mật khẩu') }}" name="password_confirm" required>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-register">{{ __('Đăng ký') }}</button>
</form>

@push('js')
    <script>
        $(".form-register").validate({
            rules: {
                name: "required",
                phone: "required",
                address: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 32
                },
                password_confirm: {
                    required: true,
                    minlength: 6,
                    maxlength: 32,
                    equalTo: '#password'
                },
            },
            messages: {
                name: {
                    required: "Trường này không được để trống"
                },
                phone: {
                    required: "Trường này không được để trống"
                },
                address: {
                    required: "Trường này không được để trống"
                },
                email: {
                    required: "Trường này không được để trống",
                    email: "Nhập không đúng định dạng email"
                },
                password: {
                    required: "Trường này không được để trống",
                    minlength: "Mật khẩu tối thiểu 6 ký tự",
                    maxlength: "Mật khẩu tối đa 32 ký tự",
                },
                password_confirm: {
                    required: "Trường này không được để trống",
                    minlength: "Mật khẩu tối thiểu 6 ký tự",
                    maxlength: "Mật khẩu tối đa 32 ký tự",
                    equalTo: "Mât khẩu không trùng nhau"
                },
            },
            submitHandler: function () {
                let url = $('.form-register').attr('action');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        name: $('input[name=name]').val(),
                        email: $('input[name=email]').val(),
                        phone: $('input[name=phone]').val(),
                        address: $('input[name=address]').val(),
                        password: $('input[name=password]').val(),
                        password_confirm: $('input[name=password_confirm]').val(),
                        current_path: $('input[name=current_path]').val(),
                    },
                    beforeSend: function () {
                        $('body').addClass('busy');
                    },
                    success: function (response) {
                        if (response.code == 200) {
                            window.location.href = response.route;
                        } else {
                            $('body').removeClass('busy');
                            if (response.code == 400 || response.code == 403 || response.code == 422) {
                                $('#register_error').html(response.message);
                                $('#register_error').show();
                            }
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        $('#register_error').html(err.responseJSON.errors.email[0]);
                        $('#register_error').show();
                        $('body').removeClass('busy');
                    }
                })
            }
        });
    </script>
@endpush