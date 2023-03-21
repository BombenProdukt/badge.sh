<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class BrokenBuildBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $hostname, string $job): array
    {
        $builds = collect($this->client->builds($hostname, $job))->filter(fn (array $build) => strtolower($build['result']) !== 'success');

        return [
            'label'        => 'Broken Builds',
            'message'      => FormatNumber::execute($builds->count()),
            'messageColor' => match (true) {
                $builds->count() < 10   => 'green.600',
                $builds->count() < 20   => 'orange.600',
                default                 => 'red.600',
            },
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
