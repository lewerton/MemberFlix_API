<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define seu "home" route para a aplicação.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define as configurações de roteamento, como bindings, pattern filters, etc.
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Se você tiver rotas web, pode descomentar:
            // Route::middleware('web')
            //     ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        // Configure o rate limiting, se necessário.
    }
}
