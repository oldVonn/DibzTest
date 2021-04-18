<?php

namespace App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TblUserController extends Controller
{
    //
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest:tbl_user')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login.tbl_user');
    }
    public function username()
    {
        return 'id';
    }
    protected function guard()
    {
        return Auth::guard('tbl_user');
    }
}
