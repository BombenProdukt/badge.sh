<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\MakeBadgeResponse;
use App\Contracts\Badge;
use App\Services\BadgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Regex\Regex;
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
            /** @var Badge */
            foreach (app('badge.service')->all() as $badge) {
                $path = $badge->routePath();
                $schema = $this->getRouteSchema($path);

                $route = Route::get($schema['path'], function (Request $request) use ($badge) {
                    $badge->setRequest($request);

                    if ($badge->routeRules()) {
                        $badge->setRequestData($request->validate($badge->routeRules()));
                    }

                    return MakeBadgeResponse::execute($request, $badge);
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
                        $type === 'string' => $route->whereAlpha($parameter),
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

    private function getRouteSchema(string $path): array
    {
        $parameters = [];

        $regex = Regex::matchAll('/\{([a-zA-Z0-9_:,]+)\}/', $path);

        foreach ($regex->results() as $result) {
            $group = $result->group(1);

            if (\str_contains($group, ':')) {
                [$name, $type] = \explode(':', $group, 2);

                $parameters[$name] = $type;
            }
        }

        return [
            'path' => \preg_replace('/(:[a-zA-Z,]+)/', '', $path),
            'parameters' => $parameters,
        ];
    }
}
