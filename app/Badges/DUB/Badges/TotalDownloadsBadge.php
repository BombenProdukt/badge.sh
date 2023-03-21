<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\AbstractBadge;
use App\Badges\DUB\Client;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return $this->renderDownloads($downloads['total']);
    }

    public function service(): string
    {
        return 'DUB';
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
            '/dub/downloads/{package}',
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
            '/dub/downloads/vibe-d' => 'total downloads',
        ];
    }
}
