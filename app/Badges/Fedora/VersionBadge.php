<?php

declare(strict_types=1);

namespace App\Badges\Fedora;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/fedora/version/{packageName}/{branch?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $branch = 'rawhide'): array
    {
        return [
            'version' => $this->client->version($packageName, $branch),
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
                path: '/fedora/version/rpm',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/fedora/version/rpm/rawhide',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
