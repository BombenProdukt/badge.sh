<?php

declare(strict_types=1);

namespace App\Badges\JCenter\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JCenter\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RepoBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $group, string $artifact): array
    {
        $response = $this->client->get(str_replace('.', '/', $group)."/{$artifact}/maven-metadata.xml");

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return $this->renderVersion($matches[1]);
    }

    public function service(): string
    {
        return 'JCenter';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/jcenter/version/{group}/{artifact}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jcenter/version/com.squareup.okhttp3/okhttp' => 'version',
        ];
    }
}
