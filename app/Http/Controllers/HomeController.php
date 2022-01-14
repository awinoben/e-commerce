<?php

namespace App\Http\Controllers;

use Exception;
use LaravelMultipleGuards\Traits\FindGuard;

class HomeController extends Controller
{
    use FindGuard;

    /**
     * create instance here
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * logout user here
     * @throws Exception
     */
    public function logout(): string
    {
        $this->findGuardType()->logout();

        return redirect()->route('welcome');
    }
}
