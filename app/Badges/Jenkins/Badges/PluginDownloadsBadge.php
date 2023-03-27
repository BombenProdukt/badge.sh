<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class PluginDownloadsBadge extends AbstractBadge
{
    protected string $route = '/jenkins/plugin-downloads/{plugin}/{version?}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $plugin, ?string $version = null): array
    {
        $response = Http::get("https://stats.jenkins.io/plugin-installation-trend/{$plugin}.stats.json")->throw()->json();

        if (empty($version)) {
            return [
                'downloads' => collect($response['installations'])->sum(),
            ];
        }

        return [
            'downloads' => collect($response['installationsPerVersion'][$version])->sum(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('downloads', $properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'plugin downloads',
                path: '/jenkins/plugin-downloads/view-job-filters',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'plugin downloads per version',
                path: '/jenkins/plugin-downloads/view-job-filters/1.26',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
