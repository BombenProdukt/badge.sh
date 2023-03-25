<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;

final class MaintainerBadge extends AbstractBadge
{
    protected array $routes = [
        '/aur/maintainer/{package}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $package): array
    {
        return [
            'maintainer' => $this->client->get($package)['Maintainer'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('maintainer', $properties['maintainer']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/aur/maintainer/google-chrome' => 'maintainer',
        ];
    }
}
