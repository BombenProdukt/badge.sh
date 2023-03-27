<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/conda/version/{channel}/{package}';

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
            new BadgePreviewData(
                name: 'version',
                path: '/conda/version/conda-forge/python',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
