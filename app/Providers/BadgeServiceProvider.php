<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\MakeBadgeResponse;
use App\Badges\AbstractBadge;
use App\Services\BadgeService;
use Illuminate\Http\Request;
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
            /** @var AbstractBadge */
            foreach (app('badge.service')->all() as $badge) {
                foreach ($badge->routePaths() as $path) {
                    $badge->routeConstraints(
                        Route::get($path, function (Request $request) use ($badge) {
                            $badge->setRequest($request);

                            if ($badge->routeRules()) {
                                $badge->setRequestData($request->validate($badge->routeRules()));
                            }

                            return MakeBadgeResponse::execute($request, $badge);
                        })
                    );
                }
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
