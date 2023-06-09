<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/ubuntu/version/{packageName}/{series?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $series = null): array
    {
        return [
            'version' => $this->client->version($packageName, $series),
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
                path: '/ubuntu/version/ubuntu-wallpapers',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/ubuntu/version/ubuntu-wallpapers/bionic',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
