<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CloudAutomatedBuildBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/cloud-automated/{scope}/{name}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $scope, string $name): array
    {
        return [
            'settingsCount' => \count($this->client->build($scope, $name)['build_settings']),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['settingsCount'] >= 1) {
            return $this->renderText('docker build', 'automated', 'green.600');
        }

        return $this->renderText('docker build', 'manual', 'yellow.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'automated',
                path: '/docker/cloud-automated/jrottenberg/ffmpeg',
                data: $this->render([]),
            ),
        ];
    }
}
