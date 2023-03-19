<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\Jenkins\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LastBuildBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $hostname, string $job): array
    {
        $response = $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration');

        return [
            'label'       => 'Last Build',
            'status'      => $response['result'],
            'statusColor' => strtolower($response['result']) === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function service(): string
    {
        return 'Jenkins';
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
            '/jenkins/{hostname}/{job}/last-build',
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
        $route->where('job', RoutePattern::CATCH_ALL->value);
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
            '/jenkins/jenkins.mono-project.com/job/test-mono-mainline/last-build' => 'Last build status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
