<?php

declare(strict_types=1);

namespace App\Badges\Conan;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/conan/version/{packageName:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        return [
            'version' => \array_key_first($this->client->get($packageName)['versions']),
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
                path: '/conan/version/boost',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
