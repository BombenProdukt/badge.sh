<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class BrokenBuildBadge extends AbstractBadge
{
    public function handle(string $hostname, string $job): array
    {
        return [
            'count' => collect($this->client->builds($hostname, $job))->filter(fn (array $build) => strtolower($build['result']) !== 'success')->count(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'Broken Builds',
            'message'      => FormatNumber::execute($properties['count']),
            'messageColor' => match (true) {
                $properties['count'] < 10 => 'green.600',
                $properties['count'] < 20 => 'orange.600',
                default                   => 'red.600',
            },
        ];
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/broken-build/{hostname}/{job}',
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
            '/jenkins/broken-build/jenkins.mono-project.com/job/test-mono-mainline' => '# of broken builds',
        ];
    }
}
