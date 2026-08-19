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
                $view->with('siteName', Company::get('company_name', 'L&L International Ventures LLC'));
                $view->with('siteTagline', Company::get('tagline', 'Professional management. Simple living.'));
                $view->with('siteMetaTitle', Company::get('meta_title', 'L&L Tenant Portal'));
                $view->with('siteMetaDescription', Company::get('meta_description', 'Your secure tenant portal for L&L International Ventures LLC.'));
                $view->with('siteMetaKeywords', Company::get('meta_keywords'));
                $view->with('siteLogo', Company::mediaUrl(Company::get('logo')));
                $view->with('siteFavicon', Company::mediaUrl(Company::get('favicon')));
                $view->with('siteOgImage', Company::mediaUrl(Company::get('og_image')));
                $view->with('siteHero', Company::mediaUrl(Company::get('property_hero'), 'images/property-hero.jpg'));
            } catch (\Throwable) {
                $view->with('companyProperty', null);
                $view->with('zelleHandle', '@LLInternationalVentures');
                $view->with('siteName', 'L&L International Ventures LLC');
                $view->with('siteTagline', 'Professional management. Simple living.');
                $view->with('siteMetaTitle', 'L&L Tenant Portal');
                $view->with('siteMetaDescription', 'Your secure tenant portal for L&L International Ventures LLC.');
                $view->with('siteMetaKeywords', null);
                $view->with('siteLogo', null);
                $view->with('siteFavicon', null);
                $view->with('siteOgImage', null);
                $view->with('siteHero', asset('images/property-hero.jpg'));
            }
        });
    }
}
