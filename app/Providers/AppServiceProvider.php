<?php

namespace App\Providers;

use App\Helpers\NotificationHelper;
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
        Blade::directive('speechNotification', function () {
            return "<?php echo " . NotificationHelper::class . "::speechScript(); ?>";
        });
    }
}
