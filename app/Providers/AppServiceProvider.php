<?php

namespace App\Providers;

use App\Support\Company;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $view->with('companyProperty', Company::property());
                $view->with('zelleHandle', Company::get('zelle_handle', '@LLInternationalVentures'));
            } catch (\Throwable) {
                $view->with('companyProperty', null);
                $view->with('zelleHandle', '@LLInternationalVentures');
            }
        });
    }
}
