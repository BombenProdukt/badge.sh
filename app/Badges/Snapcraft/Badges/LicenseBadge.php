<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/snapcraft/license/{snap}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $snap): array
    {
        return $this->client->get($snap)['snap'];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/snapcraft/license/okular' => 'license',
        ];
    }
}
