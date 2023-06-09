<?php

declare(strict_types=1);

namespace App\Badges\CRAN;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/cran/downloads/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        $genesis = \explode('T', Carbon::createFromTimestamp(0)->toISOString())[0];

        return $this->client->logs("downloads/total/{$genesis}:last-day/{$package}")[0];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total downloads',
                path: '/cran/downloads/Rcpp',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
