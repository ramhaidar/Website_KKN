<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register () : void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot () : void
    {
        // Change Locale to ID
        config ( [ 'app.locale' => 'id' ] );
        Carbon::setLocale ( 'id' );
        date_default_timezone_set ( 'Asia/Jakarta' );

        // Force to use HTTP
        // URL::forceScheme ( 'http' );
        URL::forceScheme ( 'http' );


    }
}
