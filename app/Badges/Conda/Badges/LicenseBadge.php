<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/conda/license/{channel}/{package}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $channel, string $package): array
    {
        return $this->client->get($channel, $package);
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            '/conda/license/conda-forge/python' => 'license',
        ];
    }
}
