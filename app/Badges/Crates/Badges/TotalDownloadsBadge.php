<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Crates\Client;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return $this->renderDownloads($this->client->get($package)['downloads']);
    }

    public function service(): string
    {
        return 'Crates';
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
            '/crates/downloads/{package}',
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
            '/crates/downloads/regex' => 'total downloads',
        ];
    }
}
