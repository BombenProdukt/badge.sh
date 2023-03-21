<?php

declare(strict_types=1);

namespace App\Badges\Coverity\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Coverity\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        return $this->renderStatus($this->service(), $this->client->status($projectId));
    }

    public function service(): string
    {
        return 'Coverity';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/coverity/status/{projectId}',
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
            '/coverity/status/3997' => 'status',
        ];
    }
}
