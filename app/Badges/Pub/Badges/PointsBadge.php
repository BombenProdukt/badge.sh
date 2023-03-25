<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;

final class PointsBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/points/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return $this->client->api("packages/{$package}/score");
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'popularity',
            'message' => $properties['grantedPoints'].'/'.$properties['maxPoints'],
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/pub/points/rxdart' => 'pub points',
        ];
    }
}
