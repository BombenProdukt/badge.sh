<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\VisualStudioMarketplace\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class AzureDevOpsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension, ?string $measurement = null): array
    {
        $response        = $this->client->get($extension);
        $install         = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];
        $onpremDownloads = collect($response['statistics'])->firstWhere('statisticName', 'onpremDownloads')['value'];

        if ($measurement === 'services') {
            return $this->renderDownloads($install);
        }

        if ($measurement === 'on-prem') {
            return $this->renderDownloads($onpremDownloads);
        }

        return $this->renderDownloads($install + $onpremDownloads);
    }

    public function service(): string
    {
        return 'Visual Studio Marketplace';
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
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository'          => 'downloads',
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/services' => 'downloads',
            '/vs-marketplace/azure-devops-installations/swellaby.mirror-git-repository/on-prem'  => 'downloads',
        ];
    }
}
