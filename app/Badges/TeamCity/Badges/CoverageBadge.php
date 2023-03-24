<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Badges\AbstractBadge;
use App\Badges\TeamCity\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $buildId): array
    {
        $response = $this->client->coverage($this->getRequestData('instance'), $buildId);

        $total   = null;
        $covered = null;
        foreach ($response['property'] as $property) {
            if ($property['name'] === 'CodeCoverageAbsSCovered') {
                $covered = (int) $property['value'];
            }

            if ($property['name'] === 'CodeCoverageAbsSTotal') {
                $total = (int) $property['value'];
            }
        }

        if ($covered !== null && $total !== null) {
            $coverage = $covered ? ($covered / $total) * 100 : 0;
        }

        return $this->renderCoverage($coverage ?? 0);
    }

    public function service(): string
    {
        return 'TeamCity';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/team-city/coverage/{buildId}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
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
            '/team-city/coverage/ReactJSNet_PullRequests?instance=https://teamcity.jetbrains.com' => 'coverage status',
        ];
    }
}