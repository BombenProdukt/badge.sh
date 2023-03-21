<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NPM\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->web("package/{$package}");

        preg_match('/"dependentsCount"\s*:\s*(\d+)/', $response, $matches);

        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute((int) $matches[1]),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'npm';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/npm/dependents/{package}/{tag?}',
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
            '/npm/dependents/got' => 'dependents',
        ];
    }
}
