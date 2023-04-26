<?php

declare(strict_types=1);

namespace App\Badges\PackageControl;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected string $route = '/package-control/downloads-monthly/{packageName}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        $platforms = $this->client->get($packageName)['installs']['daily']['data'];

        $total = 0;

        foreach ($platforms as $platform) {
            for ($i = 0; $i < 30; $i++) {
                $total += $platform['totals'][$i];
            }
        }

        return [
            'downloads' => $total,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'monthly downloads',
                path: '/package-control/downloads-monthly/GitGutter',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
