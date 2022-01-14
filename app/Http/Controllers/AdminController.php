<?php

namespace App\Http\Controllers;

use Exception;
use LaravelMultipleGuards\Traits\FindGuard;

class AdminController extends Controller
{
    use FindGuard;

    /**
     * create instance here
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * logout user here
     * @throws Exception
     */
    public function logout(): string
    {
        $this->findGuardType()->logout();

        return redirect()->route('admin.login');
    }
}
