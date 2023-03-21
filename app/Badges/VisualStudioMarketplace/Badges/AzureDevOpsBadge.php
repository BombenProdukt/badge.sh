<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Templates\DownloadsTemplate;
use App\Badges\VisualStudioMarketplace\Client;
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
            return DownloadsTemplate::make($install);
        }

        if ($measurement === 'on-prem') {
            return DownloadsTemplate::make($onpremDownloads);
        }

        return DownloadsTemplate::make($install + $onpremDownloads);
    }

    public function service(): string
    {
        return 'Visual Studio Marketplace';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
