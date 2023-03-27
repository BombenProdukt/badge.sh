<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PlatformBadge extends AbstractBadge
{
    protected string $route = '/conda/platform/{channel}/{package}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $channel, string $package): array
    {
        return [
            'platforms' => $this->client->get($channel, $package)['conda_platforms'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', \implode(' | ', $properties['platforms']), 'blue.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'platform',
                path: '/conda/platform/conda-forge/python',
                data: $this->render(['platforms' => ['linux-64', 'osx-64', 'win-64']]),
            ),
        ];
    }
}
