<?php

declare(strict_types=1);

namespace App\Badges\Tokei\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Tokei\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $provider, string $user, string $repo): array
    {
        return $this->renderLines($this->client->lines($provider, $user, $repo));
    }

    public function service(): string
    {
        return 'Tokei';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/tokei/lines/{provider}/{user}/{repo}',
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
            '/tokei/lines/github/badges/shields' => 'version',
        ];
    }
}
