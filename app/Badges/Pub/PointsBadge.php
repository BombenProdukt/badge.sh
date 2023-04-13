<?php

declare(strict_types=1);

namespace App\Badges\Pub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PointsBadge extends AbstractBadge
{
    protected string $route = '/pub/points/{package}';

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
            new BadgePreviewData(
                name: 'pub points',
                path: '/pub/points/rxdart',
                data: $this->render(['grantedPoints' => 0, 'maxPoints' => '100']),
            ),
        ];
    }
}
