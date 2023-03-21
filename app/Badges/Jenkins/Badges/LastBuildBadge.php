<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LastBuildBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $hostname, string $job): array
    {
        $response = $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration');

        return [
            'label'        => 'Last Build',
            'message'      => $response['result'],
            'messageColor' => strtolower($response['result']) === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function service(): string
    {
        return 'Jenkins';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/last-build/{hostname}/{job}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/last-build/jenkins.mono-project.com/job/test-mono-mainline' => 'Last build status',
        ];
    }
}
