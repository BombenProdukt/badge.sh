<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class AzureDevOpsBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/azure-devops-installations/{extension}/{measurement?}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extension, ?string $measurement = null): array
    {
        $response = $this->client->get($extension);

        return [
            'measurement' => $measurement,
            'installations' => collect($response['statistics'])->firstWhere('statisticName', 'install')['value'],
            'onpremDownloads' => collect($response['statistics'])->firstWhere('statisticName', 'onpremDownloads')['value'],
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['measurement'] === 'services') {
            return $this->renderDownloads($properties['installations']);
        }

        if ($properties['measurement'] === 'on-prem') {
            return $this->renderDownloads($properties['onpremDownloads']);
        }

        return $this->renderDownloads($properties['installations'] + $properties['onpremDownloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads',
                path: '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'downloads',
                path: '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/services',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'downloads',
                path: '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/on-prem',
                data: $this->render([]),
            ),
        ];
    }
}
