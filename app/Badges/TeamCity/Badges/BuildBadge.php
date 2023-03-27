<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BuildBadge extends AbstractBadge
{
    protected string $route = '/team-city/build/{buildId}';

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
            new BadgePreviewData(
                name: 'build status',
                path: '/team-city/build/IntelliJIdeaCe_JavaDecompilerEngineTests?instance=https://teamcity.jetbrains.com',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
