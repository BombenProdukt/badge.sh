<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/nuget/downloads/{project}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project): array
    {
        return [
            'downloads' => Http::get('https://azuresearch-usnc.nuget.org/query', [
                'q' => 'packageid:'.\mb_strtolower($project),
                'prerelease' => 'true',
                'semVerLevel' => 2,
            ])->throw()->json('data.0.totalDownloads'),
        ];
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
                path: '/nuget/downloads/Newtonsoft.Json',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
