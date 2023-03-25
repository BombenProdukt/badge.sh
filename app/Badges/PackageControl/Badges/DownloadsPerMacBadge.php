<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerMacBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads-mac/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['osx'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMac($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'macOS downloads',
                path: '/package-control/downloads-mac/GitGutter',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
