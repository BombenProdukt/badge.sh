<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\MakeBadge;
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
        $this->app->singleton('badge.service', fn () => new BadgeService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware(CacheResponse::class)->group(function (): void {
            /** @var AbstractBadge */
            foreach (app('badge.service')->all() as $badge) {
                $schema = $badge->routeSchema();

                $route = Route::get($schema['path'], function (Request $request) use ($badge) {
                    $badge->setRequest($request);

                    if ($badge->routeRules()) {
                        $badge->setRequestData($request->validate($badge->routeRules()));
                    }

                    $result = MakeBadge::execute($request, $badge);

                    if ($request->isJson()) {
                        return $result->toArray();
                    }

                    return MakeBadgeResponse::execute($request, $result->render());
                });

                // These are parameters that define their type using the {parameter:type} syntax.
                foreach ($schema['parameters'] as $parameter => $type) {
                    match (true) {
                        $type === 'alpha' => $route->whereAlpha($parameter),
                        $type === 'alphanumeric' => $route->whereAlphaNumeric($parameter),
                        $type === 'number' => $route->whereNumber($parameter),
                        $type === 'packageWithScope' => $route->where($parameter, '([a-z]+)|(@[a-z]+\/[a-z]+)'),
                        $type === 'packageWithScopeOnly' => $route->where($parameter, '(@[a-z]+\/[a-z]+)'),
                        $type === 'packageWithVendor' => $route->where($parameter, '([a-z]+)|([a-z]+\/[a-z]+)'),
                        $type === 'packageWithVendorOnly' => $route->where($parameter, '([a-z]+\/[a-z]+)'),
                        $type === 'string' => null, // Strings can be anything
                        $type === 'ulid' => $route->whereUlid($parameter),
                        $type === 'uuid' => $route->whereUuid($parameter),
                        $type === 'wildcard' => $route->where($parameter, '.*'),
                        \str_contains($type, ',') => $route->whereIn($parameter, \explode(',', $type)),
                        default => $route->where($parameter, $type),
                    };
                }

                // These are parameters that define their constraints using `where` functions.
                $badge->routeConstraints($route);
            }
        });
    }
}
