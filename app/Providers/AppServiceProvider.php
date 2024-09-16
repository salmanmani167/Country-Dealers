<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('employee', function () {
            return "<?php if(auth()->check() && auth()->user()->is_employee): ?>";
        });

        Blade::directive('endemployee', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('client', function () {
            return "<?php if(auth()->check() && auth()->user()->is_client): ?>";
        });

        Blade::directive('endclient', function () {
            return '<?php endif; ?>';
        });
    }
}
