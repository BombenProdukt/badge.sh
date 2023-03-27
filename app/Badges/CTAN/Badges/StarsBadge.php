<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/ctan/stars/{package}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        \preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'stars' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/ctan/stars/pgf-pie',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
