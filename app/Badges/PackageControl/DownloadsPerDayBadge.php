<?php

declare(strict_types=1);

namespace App\Badges\PackageControl;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/package-control/downloads-daily/{packageName}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'daily downloads',
                path: '/package-control/downloads-daily/GitGutter',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
