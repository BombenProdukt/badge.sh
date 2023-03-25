<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class PlatformsBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return $this->client->get($packageName);
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', \implode(' | ', $properties['platforms']), 'blue.600');
    }

    public function previews(): array
    {
        return [
            '/package-control/downloads/GitGutter' => 'total downloads',
        ];
    }
}
