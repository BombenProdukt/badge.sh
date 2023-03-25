<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/version/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return $this->client->api("packages/{$package}")['latest'];
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
                path: '/pub/version/kt_dart',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/pub/version/mobx',
                data: $this->render([]),
            ),
        ];
    }
}
