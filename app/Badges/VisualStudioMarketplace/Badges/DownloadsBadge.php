<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\VisualStudioMarketplace\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $response    = collect($this->client->get($extension));
        $install     = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];
        $updateCount = collect($response['statistics'])->firstWhere('statisticName', 'updateCount')['value'];

        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($install + $updateCount),
            'messageColor' => 'green.600',
        ];
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/{extension}/downloads',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vs-marketplace/vscodevim.vim/downloads' => 'downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
