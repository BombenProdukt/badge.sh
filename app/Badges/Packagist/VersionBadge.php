<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/packagist/version/{vendor}/{project}/{channel?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $vendor, string $project, ?string $channel = null): array
    {
        return [
            'version' => $this->getVersion($this->client->get($vendor, $project), $channel),
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
                path: '/packagist/version/monolog/monolog',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (pre)',
                path: '/packagist/version/monolog/monolog/pre',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (latest)',
                path: '/packagist/version/monolog/monolog/latest',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
