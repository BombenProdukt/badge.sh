<?php

declare(strict_types=1);

namespace App\Badges\Spack;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/spack/version/{packageName}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        return [
            'version' => $this->client->version($packageName),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/spack/version/adios2',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
