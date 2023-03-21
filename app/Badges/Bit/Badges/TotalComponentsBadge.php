<?php

declare(strict_types=1);

namespace App\Badges\Bit\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Bit\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TotalComponentsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $collection): array
    {
        return $this->renderNumber('components', $this->client->get($collection)['totalComponents']);
    }

    public function service(): string
    {
        return 'Bit';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/bit/components/{collection}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('collection', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bit/components/ramda/ramda' => 'total components',
        ];
    }
}
