<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Badges\AbstractBadge;
use App\Badges\TeamCity\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class BuildBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $buildId): array
    {
        return $this->renderStatus('build', $this->client->build($this->getRequestData('instance'), $buildId)['statusText']);
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
            '/team-city/build/{buildId}',
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
            '/team-city/build/IntelliJIdeaCe_JavaDecompilerEngineTests?instance=https://teamcity.jetbrains.com' => 'build status',
        ];
    }
}
