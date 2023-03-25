<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class AutomatedBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/build-automated/{scope}/{name}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $scope, string $name): array
    {
        return $this->client->info($scope, $name);
    }

    public function render(array $properties): array
    {
        if ($properties['is_automated']) {
            return $this->renderText('docker build', 'automated', 'green.600');
        }

        return $this->renderText('docker build', 'manual', 'yellow.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'automated',
                path: '/docker/build-automated/jrottenberg/ffmpeg',
                data: $this->render([]),
            ),
        ];
    }
}
