<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;

final class PopularityBadge extends AbstractBadge
{
    protected array $routes = [
        '/aur/popularity/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        return [
            'popularity' => $this->client->get($package)['Popularity'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['popularity']);
    }

    public function previews(): array
    {
        return [
            '/aur/popularity/google-chrome' => 'popularity',
        ];
    }
}
