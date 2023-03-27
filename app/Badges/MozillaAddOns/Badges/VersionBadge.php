<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/amo/version/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package)['current_version'];
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
                path: '/amo/version/markdown-viewer-chrome',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
