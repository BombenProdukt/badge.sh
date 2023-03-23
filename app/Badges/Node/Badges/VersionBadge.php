<?php

declare(strict_types=1);

namespace App\Badges\Node\Badges;

use App\Actions\DetermineColorByVersion;
use App\Badges\AbstractBadge;
use App\Badges\Node\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, ?string $tag = 'latest'): array
    {
        $version = Arr::get($this->client->get($package, $tag, $this->getRequestData('registry')), 'engines.node');

        return $this->renderText(
            $tag === 'latest' ? $package : "{$package}@{$tag}",
            $version,
            DetermineColorByVersion::execute($version),
        );
    }

    public function service(): string
    {
        return 'Node';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/node/version/{package}/{tag?}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'registry' => ['nullable', 'url'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/node/version/passport'                                                  => 'node version',
            '/node/version/passport/latest'                                           => 'node version (tag)',
            '/node/version/passport/latest?registry=https://registry.npmjs.com'       => 'node version (tag, custom registry)',
            '/node/version/@stdlib/stdlib'                                            => 'node version (scoped)',
            '/node/version/@stdlib/stdlib/latest'                                     => 'node version (scoped, tag)',
            '/node/version/@stdlib/stdlib/latest?registry=https://registry.npmjs.com' => 'node version (scoped, tag, custom registry)',
        ];
    }
}
