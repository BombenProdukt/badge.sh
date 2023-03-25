<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'maintainer',
                path: '/aur/maintainer/google-chrome',
                data: $this->render(['maintainer' => 'archlinux']),
            ),
        ];
    }
}
