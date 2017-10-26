<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }


}
