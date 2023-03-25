<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/conda/version/{channel}/{package}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $channel, string $package): array
    {
        return [
            'version' => $this->client->get($channel, $package)['latest_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/conda/version/conda-forge/python' => 'version',
        ];
    }
}
