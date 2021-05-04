<div id="modal-register-login" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close btn-close-modal-user" data-dismiss="modal" aria-label="Close">
                <i class="zmdi zmdi-close"></i>
            </button>
            <div class="modal-body">
                <div class="modal-content-left">
                    <p>
                        <b>Đăng nhập</b><br>
                        Đăng nhập để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích, nhận nhiều ưu đãi hấp dẫn.
                    </p>
                </div>
                <div class="modal-content-right">
                    <div class="box-register">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item tab-register">
                                <a class="nav-link tab-register" href="#register" role="tab" data-toggle="tab">{{ __('Đăng ký') }}</a>
                            </li>
                            <li class="nav-item tab-login">
                                <a class="nav-link tab-login" href="#login" role="tab" data-toggle="tab">{{ __('Đăng nhập') }}</a>
                            </li>
                        </ul>
                        <!-- Tab content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in tab-content-register active" id="register">
                                @include('user::user.register')
                            </div>
                            <div role="tabpanel" class="tab-pane tab-content-login fade" id="login">
                                @include('user::user.login')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>