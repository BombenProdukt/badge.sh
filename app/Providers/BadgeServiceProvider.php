<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\BadgeService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\ResponseCache\Middlewares\CacheResponse;

final class BadgeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('badge.service', fn () => new BadgeService);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware(CacheResponse::class)->group(function (): void {
            foreach (app('badge.service')->all() as $badge) {
                Route::badge($badge::class);
            }
        });
    }

    /**
     * @todo Replace this with a view composer or component.
     */
    public static function examples(): array
    {
        return app('badge.service')->dynamicPreviews();
    }
}
