<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class AzureDevOpsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/azure-devops-installations/{extension}/{measurement?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository' => 'downloads',
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/services' => 'downloads',
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/on-prem' => 'downloads',
        ];
    }
}
