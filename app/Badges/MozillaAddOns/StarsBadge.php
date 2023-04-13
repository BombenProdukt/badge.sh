<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/amo/stars/{package}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'stars' => $response['ratings']['average'],
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
                path: '/amo/stars/markdown-viewer-chrome',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
