<form class="form-login" action="{{ route('submit-login') }}" method="POST">
    @csrf
    <div class="summery_error" id="login_error" style="display: none"></div>
    <input type="hidden" name="current_path" value="{{ request()->path() }}">
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-envelope icon"></i>
            <input type="email" class="info" placeholder="{{ __('Email') }}" value="{{ old('email') }}" name="email" required>
        </div>
    </div>
    <div class="input-box">
        <div class="position-relative">
            <i class="fa fa-lock icon icon-lock"></i>
            <input type="password" class="info" placeholder="{{ __('Mật khẩu') }}" value="{{ old('password') }}" name="password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-register">{{ __('Đăng nhập') }}</button>
</form>

@push('js')
    <script>
        $(".form-login").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 32
                },
            },
            messages: {
                email: {
                    required: "Trường này không được để trống",
                    email: "Nhập không đúng định dạng email"
                },
                password: {
                    required: "Trường này không được để trống",
                    minlength: "Mật khẩu tối thiểu 6 ký tự",
                    maxlength: "Mật khẩu tối đa 32 ký tự",
                },
            },
            submitHandler: function () {
                let url = $('.form-login').attr('action');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        email: $('.form-login input[name=email]').val(),
                        password: $('.form-login input[name=password]').val(),
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
                            if (response.code == 400 || response.code == 403) {
                                $('#login_error').html(response.message);
                                $('#login_error').show();
                            }
                        }
                    },
                    error: function (err) {
                        $('body').removeClass('busy');
                        console.log(err);

                        let error = '';
                        $.each(err.responseJSON.errors, function (index, item) {
                            error += item + '<br>';
                        })

                        $('#login_error').html(error);
                        $('#login_error').show();
                    }
                })
            }
        });
    </script>
@endpush