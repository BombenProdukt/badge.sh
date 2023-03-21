<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\VisualStudioMarketplace\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $response    = $this->client->get($extension);
        $install     = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];
        $updateCount = collect($response['statistics'])->firstWhere('statisticName', 'updateCount')['value'];

        return $this->renderDownloads($install + $updateCount);
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
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/downloads/{extension}',
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
            '/vs-marketplace/downloads/vscodevim.vim' => 'downloads',
        ];
    }
}
