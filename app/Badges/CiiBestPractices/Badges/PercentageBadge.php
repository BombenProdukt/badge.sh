<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CiiBestPractices\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PercentageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        return $this->renderCoverage($this->client->get($projectId)['tiered_percentage'], 'cii');
    }

    public function service(): string
    {
        return 'CII Best Practices';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/percentage/{projectId}',
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
            '/cii/percentage/29' => 'percentage',
        ];
    }
}
