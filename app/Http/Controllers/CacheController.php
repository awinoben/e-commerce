<?php

namespace App\Http\Controllers;

use App\Models\PaymentOption;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use World\Countries\Model\Country;

class CacheController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * cache all the countries
     * @return mixed
     */
    public static function cacheCountries()
    {
        return Cache::remember('countries', now()->addMinutes(), function () {
            return Country::all()->sortBy('name');
        });
    }

    /**
     * cache all the countries
     * @return mixed
     */
    public static function cacheRoles()
    {
        return Cache::remember('roles', now()->addMinutes(), function () {
            return Role::all()->sortBy('name');
        });
    }

    /**
     * cache all the payment options
     * @return mixed
     */
    public static function cachePaymentOptions()
    {
        return Cache::remember('payment_options', now()->addMinutes(), function () {
            return PaymentOption::all()->sortBy('name');
        });
    }
}
