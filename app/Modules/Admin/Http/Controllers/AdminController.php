<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class AdminController extends AppController
{
    public function login() {
        if (Auth()->guard('admin')->user()) {
            return redirect(route('admin.dashboard'));
        }
        return view('admin::auth.login');
    }

    public function signIn(AdminLoginRequest $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = isset($request->remember) ? true : false;

        if ( Auth()->guard('admin')->attempt($credentials, $remember) ) {
            $url = self::_getRedirectUrl();
            return redirect($url);
        } else {
            $request->session()->flash('login-error', 'Sai tài khoản hoặc mật khẩu');
            return redirect()->back();
        }
    }

    private function _getRedirectUrl() {
        if (Session::has('admin_redirect_url')) {
            $url = Session::get('admin_redirect_url');
            Session::forget('admin_redirect_url');
        } else {
            $url = route('admin.dashboard');
        }

        return $url;
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
