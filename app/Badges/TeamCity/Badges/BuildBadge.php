<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Enums\Category;

final class BuildBadge extends AbstractBadge
{
    protected array $routes = [
        '/team-city/build/{buildId}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $buildId): array
    {
        return [
            'status' => $this->client->build($this->getRequestData('instance'), $buildId)['statusText'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            '/team-city/build/IntelliJIdeaCe_JavaDecompilerEngineTests?instance=https://teamcity.jetbrains.com' => 'build status',
        ];
    }
}
