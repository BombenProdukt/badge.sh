<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;

final class PlatformBadge extends AbstractBadge
{
    protected array $routes = [
        '/conda/platform/{channel}/{package}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $channel, string $package): array
    {
        return [
            'platforms' => $this->client->get($channel, $package)['conda_platforms'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', \implode(' | ', $properties['platforms']), 'blue.600');
    }

    public function previews(): array
    {
        return [
            '/conda/platform/conda-forge/python' => 'platform',
        ];
    }
}
