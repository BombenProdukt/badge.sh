<?php

declare(strict_types=1);

namespace App\Badges\Tidelift\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $platform, string $name): array
    {
        return [
            'location' => $this->client->get($platform, $name),
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['location'])) {
            return [
                'label' => 'tidelift',
                'message' => 'not found',
                'messageColor' => 'red.600',
            ];
        }

        [, $status, $statusColor] = \explode('-', \parse_url(\urldecode($properties['location']))['path']);

        return [
            'label' => 'tidelift',
            'message' => \str_replace('!', '', $status),
            'messageColor' => \str_replace('.svg', '', $statusColor),
        ];
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/tidelift/status/{platform}/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/tidelift/status/npm/minimist' => 'subscription',
            '/tidelift/status/npm/got' => 'subscription',
        ];
    }
}
