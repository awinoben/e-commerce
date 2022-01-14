<?php

namespace App\Providers;

use App\Charts\AdminChart;
use App\Charts\UserChart;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @param Charts $charts
     * @return void
     */
    public function boot(Charts $charts)
    {
        Paginator::useBootstrap();

        $charts->register([
            AdminChart::class,
            UserChart::class
        ]);
    }
}
