<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileWebRequest;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Str;
use DB;
use App\Http\Controllers\Controller;

class UserController extends AppController
{
    private $user;

    public function __construct(User $user) {
        parent::__construct();
        $this->user = $user;
    }

    public function register() {
        return view('user::user.register');
    }

    public function postRegister(RegisterRequest $request) {
        $params = $request->all();
        $current_path = '/'.$params['current_path'];
        $current_path = str_replace($current_path, '//', '/');
        DB::beginTransaction();

        $created = $this->user->create([
            'name' => $params['name'],
            'email' => $params['email'],
            'remember_token' => Str::random(60),
            'password' => Hash::make($params['password_confirm']),
        ]);

        if ($created) {
            DB::commit();
            $existUser = $this->user->where('email', $created->email)->first();
            Auth::login($existUser, true);
            return response()->json([
                'code' => 200,
                'message' => __('Register account successfully'),
                'route' => $current_path
            ]);
        } else {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function login() {
        return view('user::user.login');
    }

    public function postLogin(LoginRequest $request) {
        $params = $request->all();
        $current_path = '/'.$params['current_path'];
        $current_path = str_replace($current_path, '//', '/');

        $remember = isset($params['remember']) ? true : false;
        if(Auth::guard('web')->attempt([
            'email'=>$params['email'], 
            'password'=>$params['password']
        ], $remember)){
            return response()->json([
                'code' => 200,
                'message' => 'login success',
                'route' => $current_path
            ]);
        } else{
            return response()->json([
                'code' => 400,
                'message' => 'Sai tài khoản hoặc mật khẩu!'
            ]);
        }
    }

    public function logout() {
        auth()->guard('web')->logout();
        return redirect(route('home'));
    }

    public function profile() {
        return view('user::user.profile');
    }

    public function updateProfile(ProfileWebRequest $request) {
        $params = $request->all();
        User::where('email', $params['email'])->update([
            'name' => $params['name'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'address' => $params['address'],
        ]);

        return redirect()->back()->with('alert-success', 'Cập nhật thông tin cá nhân thành công');
    }
}
